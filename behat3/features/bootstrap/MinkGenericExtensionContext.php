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
class MinkGenericExtensionContext extends AssertationsContext implements Context
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
                throw new Exception("Erro ao processar a função.");
            }

            sleep($sleep);
            $counter++;
        }
    }

    /**
    *@When aguardo e sigo o link ":arg1"
    */
    public function waitForLinkAndClick($element)
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

    /**
    *@When aguardo e pressiono ":arg1"
    */
    public function waitForButtonAndClick($textForButton)
    {
        $this->waitForLoad(function() use (&$textForButton){
            try {
                $this->pressButton($textForButton);
                return true;
            } catch (Exception $e) {
                return false;
            }
        });
    }

    public function fillAutocompleteField($autocompleteFieldXpath, $valueToFill)
    {
        try {
            $newValueToFill = strtolower(substr($valueToFill,0,4));
            $element = $this->getSession()->getPage()->find('xpath', '#'.$autocompleteFieldXpath);
            $this->getSession()->getDriver()->executeScript("
                var element = $('#".$autocompleteFieldXpath."');
                element.val('".$newValueToFill."');
                element.keydown();
            ");
        } catch (Exception $e) {
            throw new Exception("Erro ao preencher o campo de autocomplete que possui o id '".$autocompleteFieldXpath."'");
        }
    }

    /**
    *@When digito ":arg1" na caixa de texto ":arg2"
    */
    public function fillFieldByLabel($valueToFill, $labelText)
    {
        $textbox = $this->getElementByLabelText($labelText);
        $textboxId = $textbox->getAttribute('id');
        $this->fillField($textboxId, $valueToFill);
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
    * @Then aguardo e marco o radiobutton ":arg1"
    */
    public function waitAndCheckRadioButton($labelForRadioButton)
    {
            $this->waitForLoad(function() use(&$labelForRadioButton){
                try {
                    return $this->clickElementByLabelText($labelForRadioButton, "Radio Button");
                } catch (Exception $e) {
                        return false;
                }
            });
    }


    /**
    * @When aguardo e seleciono :arg1 da caixa de seleção :arg2 
    */
    public function waitAndSelectOption($option, $name)
    {
        $this->waitForLoad(function() use(&$option, &$name){
            try {
                return $this->selectState($option, $name);
            } catch (Exception $e) {
                return false;
            }
        });
    }

    /**
    * @Then marco o radiobutton ":arg1"
    */
    public function iCheckTheRadioButton($label)
    {
        $this->clickElementByLabelText($label, "Radio Button");
    }

    /**
    * @Then marco o checkbox ":arg1"
    */
    public function iCheckTheCheckBox($label)
    {
        $this->clickElementByLabelText($label, "Check Box");
    }

    /**
     * @When seleciono ":arg1" da caixa de seleção ":arg2"
     */
    public function selectState($option, $name) {
        $page          = $this->getSession()->getPage();
        $selectElement = $page->find('xpath', '//select[@data-name = "' . $name . '"]');

        if (null === $selectElement) {
            throw new Exception("Erro ao selecionar a caixa de seleção ".$name);
        }

        $selectElement->selectOption($option);
        return true;
    }

    /**
    *@Then o teste está finalizado
    */
    public function resetSession()
    {
        $this->getSession()->reset();
    }

}