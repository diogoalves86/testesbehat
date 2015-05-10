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
    public function waitForLoad($function, $callBackValue, $callBackLimit)
    {
        $callBackCounter = 0;
        while (true)
        {
            try {
                $callBackCounter++;    
                if ($function($this) == true) {
                    return true;
                }
                if ($callBackCounter == $callBackLimit)
                    throw new Exception("A requesição solicitada demorou mais tempo que o tempo de callback definido. \n", 1);
                
            } catch (Exception $e) {
                throw new Exception("Erro ao verificar se o elemento de seletor é visível. \n".$e->getMessage());                
            }

            sleep($callBackValue);
        }
    }   


    public function isPageLoadedByClickLink($pageUri, $callBackValue, $callBackLimit)
    {
         $this->waitForLoad(function() use (&$pageUri) {
            $this->clickLink($pageUri);
            return true;
        }, $callBackValue, $callBackLimit);
    }

    public function isPageLoadedByButtonClick($pageUri, $callBackValue, $callBackLimit)
    {
         $this->waitForLoad(function() use(&$pageUri) {
            $this->pressButton($pageUri);
            return true;
        }, $callBackValue, $callBackLimit);
    }

    public function isVisibleElement($cssSelector, $callBackValue, $callBackLimit)
    {
        $this->waitForLoad(function() use (&$cssSelector) {
            $this->currentElement = $this->getSession()->getPage()->find('css', $cssSelectorParameter);
            return $this->currentElement->isVisible() == true ? true:false;
        }, $callBackValue, $callBackLimit);
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