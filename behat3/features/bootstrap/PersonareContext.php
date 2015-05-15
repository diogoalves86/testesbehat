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
    public function waitForLoad($function, $sleep=2)
    {
        while(true){
            try {
                if ($function($this) === true) {
                    return true;
                }
            } catch (Exception $e) {
                throw new Exception("Erro ao executar a função. \n Informações detalhadas: \n".$e->getMessage());
            }
        }
        sleep($sleep);
    }   

    public function isReadyElementById($elementID, $callBackLimit = 10000)
    {
         $this->waitForLoad(function() use(&$elementID, &$callBackLimit) {
            if($this->getSession()->getDriver()->evaluateScript('document.getElementById("'.$elementID.'") != null'))
                return true;
            else
                return false;
        });
    }

    public function isReadyElementByCssSelector($cssSelector, $callBackLimit = 10000)
    {
         $this->waitForLoad(function() use(&$cssSelector, &$callBackLimit) {
            if($this->getSession()->getDriver()->evaluateScript('document.querySelector("'.$cssSelector.'") != null'))
                return true;
            else
                return false;
        });
    }

    public function isVisibleElement($elementID, $callBackLimit=10000)
    {
        // $this->waitForLoad(function() use(&$elementID, &$callBackLimit) {
        //     $isVisible = $this->getSession()->wait($callBackLimit, 'document.getElementById("'.$elementID.'").offsetParent != null');
        //     return $isVisible == true ? true:false;
        // });
        $this->waitForLoad(function() use(&$elementID, &$callBackLimit) {
            $page = $this->getSession()->getPage();
            if($page->find('css', '#'.$elementID)->isVisible())
                return true;
            else
                return false;
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
            $this->visit("/login?ReturnToURL=L2FzdHJvbG9naWEvaG9yb3Njb3Bv");
            $this->fillField("txEmail", $username);
            $this->fillField("pwPassword", $password);
            $this->pressButton("psr-user-login");
            if($this->isReadyElementById("psr-user-navbar-logged", 2000))
                return true;
        } catch (Exception $e) {
            throw new Exception("Não foi possível realizar o login do usuário ".$username.".\nInformações detalhadas do erro: ".$e->getMessage());   
        }
    }

    public function checkRadioButton($elementID)
    {
        try {
            $radioButton = $this->getSession()->getPage()->find('css', '#'.$elementID);
            $radioButton->click();
        } catch (Exception $e) {
            throw new Exception("Não foi clicar no elemento de ID ".$elementID."\nInformações detalhadas do erro: ".$e->getMessage());   
        }
    }

    /**
    *@Then o teste está finalizado
    */
    public function resetSession()
    {
        $this->getSession()->reset();
    }
}