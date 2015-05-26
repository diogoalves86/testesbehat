<?php
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
 
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Hook\Scope\BeforeStepScope;
use Behat\Behat\Hook\Scope\AfterFeatureScope;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Context;
class MinkGenericExtensionContext extends MinkContext implements Context
{

	// Espera o elemento estar visível para então poder interagir com ele.
    public function waitForLoad($function, $sleep = 1)
    {
        $counter = 0;
        while (true)
        {
            if($counter >= ProjectConfig::CALLBACKTIMEOUT)
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

    public function proccessElementById($elementID, $canElementNotExist = false, $sleep = 2)
    {
        $this->isReadyProcessedElement = false;
        $this->waitForLoad(function() use(&$elementID, &$canElementNotExist) {
        $isReady = $this->getSession()->getDriver()->evaluateScript('document.getElementById("'.$elementID.'") != null');
        if($isReady === true && $canElementNotExist == false){
            $this->isReadyProcessedElement = true;
            return true;
        }
        
        else if($isReady !== true && $canElementNotExist == true)
            return true;

        else
            return false;
        }, $sleep);
    }

    public function proccessElementByCssSelector($cssSelector, $canElementNotExist = false, $sleep = 2)
    {
        $this->isReadyProcessedElement = false;
        $this->waitForLoad(function() use(&$cssSelector, &$canElementNotExist) {
            $isReady = $this->getSession()->getDriver()->evaluateScript('document.querySelector("'.$cssSelector.'") != null');
            if($isReady === true){
                $this->isReadyProcessedElement = true;
                return true;
            }

            else if($isReady !== true && $canElementNotExist == true)
              return true;

            else
                return false;
        }, $sleep);
    }

    public function processElementVisibility($elementID, $sleep = 2)
    {
        $this->isVisibleProcessedElement = false;
        $this->waitForLoad(function() use(&$elementID) {
            $elements = $this->getSession()->getPage()->findAll('css', '#'.$elementID);
            if($elements !== null){
                foreach ($elements as $element)
                    if ($element->isVisible()){
                        $this->isVisibleProcessedElement = true;
                        return true;
                    }
                return false;
            }
        }, $sleep);
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

    /** @AfterFeature */
    public static function teardownFeature(AfterFeatureScope $scope){
        var_dump($scope); exit;
    }
	
}