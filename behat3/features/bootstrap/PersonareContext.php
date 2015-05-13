<?php 
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
 
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Hook\Scope\BeforeStepScope;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Context;

/**
* Classe responsável pelo contexto geral do Personare
*/
class PersonareContext extends MinkContext implements Context
{
    public $cssID, $currentElement;


    // Espera o elemento estar visível para então poder interagir com ele.
    public function waitForLoad($function)
    {
        while (true)
        {
            try {
                if ($function($this) == true) {
                    return true;
                }
                
            } catch (Exception $e) {
                throw new Exception("Erro ao verificar se o elemento de seletor é visível. \n".$e->getMessage());                
            }
            sleep(1);
        }
    }   

    public function isReadyElementById($elementID, $callBackValue)
    {
         $this->waitForLoad(function() use(&$elementID, &$callBackValue) {
            $this->getSession()->wait($callBackValue, 'document.getElementById("'.$elementID.'") != null');
            return true;
        });
    }

    public function isReadyElementByCssSelector($cssSelector, $callBackValue)
    {
         $this->waitForLoad(function() use(&$cssSelector, &$callBackValue) {
            $this->getSession()->wait($callBackValue, 'document.querySelector("'.$cssSelector.'") != null');
            return true;
        });
    }

    public function isVisibleElement($cssSelector)
    {
        $this->waitForLoad(function() use (&$cssSelector) {
            $elements = $this->getSession()->getPage()->findAll('css', $cssSelector);
            foreach ($elements as $element) {
                return $element->isVisible() == true ? true:false;
            }
        });
    }

	/**
	* @Given aguardo :arg1 segundos
	*/
	public function waitForAct($secondsToWait)
	{
		try {
			$milisecondsToWait = $secondsToWait * 1000;
			$this->getSession()->wait($milisecondsToWait);
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
	
    /**
    * @Given estou logado no sistema com o usuário :arg1 e a senha :arg2
    */
    public function userLogged($username, $password)
    {
        try {
            $this->visit("/login");
            $this->fillField("txEmail", $username);
            $this->fillField("pwPassword", $password);
            
            if($this->isReadyElementById("psr-user-login", 2000)){
                $this->pressButton("psr-user-login");
                if(!$this->isReadyElementById("psr-user-navbar-logged"))
                    throw new Exception("Erro ao autenticar usuário: ".$username.".\nInformações detalhadas do erro: ".$e->getMessage());          
            }
        } catch (Exception $e) {
            throw new Exception("Não foi realizar o login do usuário ".$username.".\nInformações detalhadas do erro: ".$e->getMessage());   
        }
    }
}