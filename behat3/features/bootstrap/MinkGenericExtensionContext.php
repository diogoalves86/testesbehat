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

    /**
    *@When clico no link ":arg1"
    */
    public function clickElement($element)
    {
        $this->waitForLoad(function() use (&$element){
            try {
                $this->clickLink($element);
                return true;
            } catch (Exception $e) {
                return false;
            }
        });
    }

    public function assertElementIsOnPageById($elementID, $canElementNotExist = false, $sleep = 2)
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

    public function fillAutocompleteField($autocompleteFieldId, $valueToFill)
    {
        try {
            $newValueToFill = strtolower(substr($valueToFill,0,4));
            $element = $this->getSession()->getPage()->find('css', '#'.$autocompleteFieldId);
            $this->getSession()->getDriver()->executeScript("
                var element = $('#".$autocompleteFieldId."');
                element.val('".$newValueToFill."');
                element.keydown();
            ");
        } catch (Exception $e) {
            throw new Exception("Erro ao preencher o campo de autocomplete que possui o id '".$autocompleteFieldId."'");
        }
    }
    
    public function assertElementIsOnPageByQuerySelector($querySelector, $canElementNotExist = false, $sleep = 2)
    {
        $this->isReadyProcessedElement = false;
        $this->waitForLoad(function() use(&$querySelector, &$canElementNotExist) {
            $isReady = $this->getSession()->getDriver()->evaluateScript('document.querySelector("'.$querySelector.'") != null');
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

    public function assertElementIsVisibleOnPageById($elementID, $sleep = 2)
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

    public function getElementsByLabelText($labelForElement)
    {
        $elements = [];
        $page = $this->getSession()->getPage();
        foreach ($page->findAll('css', 'label') as $label) {
            if ($labelForElement == $label->getText()) {
                $forAttribute = $label->getAttribute('for');
                array_push($page->findById($forAttribute), $elements);
            }
        }
        return $elements;
    }

    /**
    * @Then marco o radiobutton ":arg1"
    */
	public function checkRadioButton($labelForRadioButton)
    {
        $elements = $this->getElementsByLabelText($labelForRadioButton);
        $isRadioButton = false;
        foreach ($elements as $element) {
            if ($element) {
                $type = $element->getAttribute('type');
                if ($type and $type === 'radio'){
                    $isRadioButton = true;
                    return true;
                }
                throw new Exception('Erro ao selecionar o Radio Button que possui o texto {{$labelForRadioButton}}');
                
            }
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