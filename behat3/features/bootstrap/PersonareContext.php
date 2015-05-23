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
    public $isVisibleProcessedElement = false;
    public $isReadyProcessedElement = false;

    // Espera o elemento estar visível para então poder interagir com ele.
    public function waitForLoad($function, $sleep = 1, $callBackLimit = 10)
    {
        $counter = 0;
        while (true)
        {
            if($counter >= $callBackLimit)
                throw new Exception("O tempo limite definido foi atingido!");
                
            try {
                if ($function($this)) {
                    return true;
                }
            } catch (Exception $e) {
                throw new Exception("Erro ao acessar função de callback. Informações detalhadas: \n".$e->getMessage());
                
            }

            sleep($sleep);
            $counter++;
        }
    }  

    public function proccessElementById($elementID, $canElementNotExist = false, $sleep = 2, $callBackLimit = 10)
    {
        $this->isReadyProcessedElement = false;
        $this->waitForLoad(function() use(&$elementID, &$canElementNotExist , &$callBackLimit) {
        $isReady = $this->getSession()->getDriver()->evaluateScript('document.getElementById("'.$elementID.'") != null');
        if($isReady === true && $canElementNotExist == false){
            $this->isReadyProcessedElement = true;
            return true;
        }
        
        else if($isReady !== true && $canElementNotExist == true)
            return true;

        else
            return false;
        }, $sleep, $callBackLimit);
    }

    public function proccessElementByCssSelector($cssSelector, $canElementNotExist = false, $sleep = 2, $callBackLimit = 10)
    {
        $this->isReadyProcessedElement = false;
        $this->waitForLoad(function() use(&$cssSelector, &$canElementNotExist , &$callBackLimit) {
            $isReady = $this->getSession()->getDriver()->evaluateScript('document.querySelector("'.$cssSelector.'") != null');
            if($isReady === true){
                $this->isReadyProcessedElement = true;
                return true;
            }

            else if($isReady !== true && $canElementNotExist == true)
              return true;

            else
                return false;
        }, $sleep, $callBackLimit);
    }

    public function processElementVisibility($elementID, $sleep = 2, $callBackLimit=10)
    {
        $this->isVisibleProcessedElement = false;
        $this->waitForLoad(function() use(&$elementID, &$callBackLimit) {
            $elements = $this->getSession()->getPage()->findAll('css', '#'.$elementID);
            if($elements !== null){
                foreach ($elements as $element)
                    if ($element->isVisible()){
                        $this->isVisibleProcessedElement = true;
                        return true;
                    }
                return false;
            }
        }, $sleep, $callBackLimit);
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
            $this->processElementVisibility('psr-user-navbar-logged');
            
            if(!$this->isVisibleProcessedElement)
                throw new Exception("Erro ao processar elemento!");
                
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

    public function prepareCity($cityField, $cityName)
    {
        try {
            $cssSelector = ".ui-autocomplete.ui-menu.ui-widget.ui-widget-content.ui-corner-all > li:nth-child(1) > a";
            $this->fillField($cityField, $cityName);
            $this->waitForAct(2);
            $this->proccessElementByCssSelector($cssSelector);
            
            if(!$this->isReadyProcessedElement)
                throw new Exception("Erro ao processar elemento!");
                
            $elements = $this->getSession()->getPage()->findAll('css', $cssSelector);
            foreach ($elements as $element) {
                $element->click();
            }
        } catch (Exception $e) {
            throw new Exception("Ocorreu um erro ao escolher a cidade do cadastro. \n".$e->getMessage());   
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