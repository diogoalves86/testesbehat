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


    public function waitLoadToClickLink($elementID, $callBackValue, $conditionToLoad)
    {
         $this->waitForLoad(function() use(&$elementID, &$callBackValue, &$conditionToLoad) {
            $this->clickLink($elementID);
            $this->getSession()->wait($callBackValue, $conditionToLoad);
            return true;
        });
    }

    public function waitLoadToPressButton($elementID, $callBackValue, $conditionToLoad)
    {
         $this->waitForLoad(function() use(&$elementID, &$callBackValue, &$conditionToLoad) {
            $this->pressButton($elementID);
            $this->getSession()->wait($callBackValue, $conditionToLoad);
            return true;
        });
    }

    public function waitElementBeVisible($elementID, $callBackValue, $conditionToLoad)
    {
         $this->waitForLoad(function() use(&$elementID, &$callBackValue, &$conditionToLoad) {
            $this->getSession()->wait($callBackValue, 'document.getElementById('.$elementID.') !== null');
            return true;
        });
    }

    public function isVisibleElement($cssSelector, $callBackValue, $callBackLimit)
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
	public function doLoginForScenario($username, $password)
	{
		$this->userLogged($username, $password);
	}
	
    /*
    * Este método tem o papel de logar o usuário no caso de testes que precisem do usuário logado.
    * Por exemplo, os testes de carrinho. 
    */
    public function userLogged($username, $password)
    {
        try {
            $this->visit("/login");
            $this->fillField("txEmail", $username);
            $this->fillField("pwPassword", $password);
            $this->pressButton("psr-user-login");
            $this->waitForAct(6);
        } catch (Exception $e) {
            throw new Exception("Não foi realizar o login do usuário ".$username.".\nInformações detalhadas do erro: ".$e->getMessage());   
        }
    }
}