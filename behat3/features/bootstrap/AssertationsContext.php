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

class AssertationsContext extends MinkContext
{

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


    public function assertElementIsOnPageByTagName($tagName, $canElementNotExist = false, $sleep = 2)
    {
        $this->isReadyProcessedElement = false;
        $this->waitForLoad(function() use(&$tagName, &$canElementNotExist) {
            $isReady = $this->getSession()->getDriver()->evaluateScript('document.getElementsByTagName("'.$tagName.'") != null');
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

    public function assertElementIsOnPageByXpath($xpath, $canElementNotExist = false, $sleep = 2)
    {
        $this->isReadyProcessedElement = false;
        $this->waitForLoad(function() use(&$xpath, &$canElementNotExist) {
            $isReady = $this->getSession()->getDriver()->evaluateScript("document.evaluate('".$xpath."', document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue != null");
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
    *@Then a caixa de texto ":arg1" deve conter ":arg2"
    */
    public function assertTextboxContainsText($labelForTextbox, $textToVerify)
    {
        $textbox = $this->getElementByLabelText($labelForTextbox);
        $textboxId = $textbox->getAttribute('id');
        $this->assertFieldContains($textboxId, $textToVerify);

    }

    public function getElementByLabelText($labelForElement)
    {
        $element = false;
        $this->waitForLoad(function() use (&$labelForElement, &$element){
            $this->assertElementIsOnPageByTagName('label', $this->getSession()->getPage()->findAll('css', 'label'));

            if (!$this->isReadyProcessedElement)
                throw new Exception("Erro ao processar elemento!");

            $labelElements = $this->getSession()->getPage()->findAll('css', 'label');
            foreach ($labelElements as $label) {
                $this->assertElementIsOnPageByXpath($label->getXpath());

                if(!$this->isReadyProcessedElement)
                    throw new Exception("Erro ao processar elemento!");

                if ($labelForElement == $label->getText()) {
                    $forAttribute = $label->getAttribute('for');
                    $element = $this->getSession()->getPage()->find('css', '#'.$forAttribute);
                    return true;
                }
            }
            return false;
        });
        if(!$element)
            throw new Exception("Erro ao processar a label '".$labelForElement."'");
        return $element;
    }

    public function clickElementByLabelText($label, $typeLabel)
    {
        $element = $this->getSession()->getPage()->findField($label);

        if (null === $element) {
            throw new Exception("Erro ao encontrar o elemento o $typeLabel que possui o texto ".$label);
        }

        $value = $element->getAttribute('value');
        $this->getSession()->getDriver()->click($element->getXPath());
        return true;
    }

}