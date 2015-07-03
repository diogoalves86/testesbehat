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
    * @Then marco o radiobutton ":arg1"
    */
	public function checkRadioButton($labelForRadioButton)
    {
        $radioButton = $this->getElementByLabelText($labelForRadioButton);
        //var_dump($radioButton); exit;
        //foreach ($radioButtons as $radioButton) {
        if ($radioButton) {
            $type = $radioButton->getAttribute('type');
            if ($type && $type === 'radio'){
                $radioButton->click();
                return true;
            }
            throw new Exception('Erro ao selecionar o Radio Button que possui o texto '.$labelForRadioButton);

        }
        //}
    }

    // /**
    // * @Then marco o radiobutton ":arg1"
    // */
    // public function checkRadioButton($elementID)
    // {
    //      try {
    //         $this->assertElementIsOnPageById($elementID);
    //         if(!$this->isReadyProcessedElement)
    //             throw new Exception("Erro ao processar elemento");

    //         $radioButton = $this->getSession()->getPage()->find('css', '#'.$elementID);
    //         $radioButton->click();
    //     } catch (Exception $e) {
    //         throw new Exception("Não foi clicar no elemento de ID ".$elementID."\nInformações detalhadas do erro: ".$e->getMessage());
    //     }
    // }

    /**
    *@Then o teste está finalizado
    */
    public function resetSession()
    {
        $this->getSession()->reset();
    }

}