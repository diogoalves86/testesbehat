<?php
use Behat\Behat\Context\ClosuredContextInterface, Behat\Behat\Context\TranslatedContextInterface, Behat\Behat\Context\BehatContext, Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode, Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Hook\Scope\BeforeStepScope;
use Behat\Behat\Hook\Scope\AfterFeatureScope;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Context;
class MinkGenericExtensionContext extends MinkContext implements Context {
	/**
	 * @When aguardo e sigo o link ":arg1"
	 */
	public function waitForLinkAndClick($element) {
		$this->waitForLoad ( function () use(&$element) {
			try {
				$this->clickLink ( $element );
				return true;
			} catch ( Exception $e ) {
				return false;
			}
		} );
	}
	
	/**
	 * @When aguardo e pressiono ":arg1"
	 */
	public function waitForButtonAndClick($textForButton) {
		$this->waitForLoad ( function () use(&$textForButton) {
			try {
				$this->pressButton ( $textForButton );
				return true;
			} catch ( Exception $e ) {
				return false;
			}
		} );
	}
	
	/**
	 * @When digito ":arg1" na caixa de texto ":arg2"
	 */
	public function fillFieldByLabel($valueToFill, $labelText) {
		$textbox = $this->getElementByLabelText ( $labelText );
		$textboxId = $textbox->getAttribute ( 'id' );
		$this->fillField ( $textboxId, $valueToFill );
	}
	
	/**
	 * @Given aguardo :arg1 segundos
	 */
	public function waitForAct($secondsToWait) {
		try {
			$milisecondsToWait = $secondsToWait * 1000;
			$this->getSession ()->wait ( $milisecondsToWait );
		} catch ( Exception $e ) {
			throw new Exception ( $e->getMessage () );
		}
	}
	
	/**
	 * @Then aguardo e marco o radiobutton ":arg1"
	 */
	public function waitAndCheckRadioButton($labelForRadioButton) {
		$this->waitForLoad ( function () use(&$labelForRadioButton) {
			try {
				return $this->clickElementByLabelText ( $labelForRadioButton, "Radio Button" );
			} catch ( Exception $e ) {
				return false;
			}
		} );
	}
	
	/**
	 * @Given que estou no Desktop
	 */
	public function runTestOnDesktop() {
		$this->getSession ()->maximizeWindow ();
	}
	
	/**
	 * @Then marco o radiobutton ":arg1"
	 */
	public function iCheckTheRadioButton($label) {
		$this->clickElementByLabelText ( $label, "Radio Button" );
	}
	
	/**
	 * @Then marco o checkbox ":arg1"
	 */
	public function iCheckTheCheckBox($label) {
		$this->clickElementByLabelText ( $label, "Check Box" );
	}
	
	/**
	 * @When seleciono ":arg1" da caixa de seleção ":arg2"
	 */
	public function selectState($option, $name) {
		$page = $this->getSession ()->getPage ();
		$selectElement = $page->find ( 'xpath', '//select[@data-name = "' . $name . '"]' );
		
		if (null === $selectElement) {
			throw new Exception ( "Erro ao selecionar a caixa de seleção " . $name );
		}
		
		$selectElement->selectOption ( $option );
	}
	public function autoCompleteField($fieldID, $widgetID, $fieldValue, $optionToSelectId) {
		try {
			
			$this->assertElementOnPageById ( $widgetID );
			
			$this->fillAutocompleteField ( $fieldID, $fieldValue );
			$this->assertElementOnPageById ( $optionToSelectId );
			$this->clickLink ( $optionToSelectId );
		} catch ( Exception $e ) {
			throw new Exception ( "Ocorreu um erro ao escolher a cidade do cadastro. \n" . $e->getMessage () );
		}
	}
	
	/**
	 * @Then o teste está finalizado
	 */
	public function resetSession() {
		$this->getSession ()->reset ();
	}
	
	// Espera o elemento estar visível para então poder interagir com ele.
	private function waitForLoad($function, $sleep = 1) {
		$counter = 0;
		while ( true ) {
			if ($counter >= ProjectConfig::CALLBACKTIMEOUT)
				throw new Exception ( "O tempo limite definido foi atingido!" );
			
			if ($function ( $this ))
				return true;
			sleep ( $sleep );
			$counter ++;
		}
	}
	public function assertElementOnPage($condition, $canElementNotExist = false, $sleep = 2) {
		$this->waitForLoad ( function () use(&$canElementNotExist, &$condition) {
			$isReady = $this->evaluateElementByCondition ( $condition );
			if ($isReady === true && $canElementNotExist == false)
				return true;
			else if ($isReady !== true && $canElementNotExist == true)
				return true;
			else
				return false;
		}, $sleep );
	}
	public function evaluateElementByCondition($condition) {
		return $this->getSession ()->getDriver ()->evaluateScript ( $condition );
	}
	public function assertElementOnPageById($elementId) {
		$condition = sprintf ( "document.getElementById('%s') != null", $elementId );
		$this->assertElementOnPage ( $condition );
	}
	public function assertElementIsOnPageByQuerySelector($querySelector) {
		$condition = sprintf ( "document.querySelector('%s') != null", $querySelector );
		$this->assertElementOnPage ( $condition );
	}
	public function assertElementIsOnPageByTagName($elementTagName) {
		$condition = sprintf ( "document.getElementsByTagName('%s') != null", $elementTagName );
		$this->assertElementOnPage ( $condition );
	}
	public function assertElementIsOnPageByXpath($elementXpath) {
		$condition = sprintf ( "document.evaluate('%s', document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue != null", $elementXpath );
		$this->assertElementOnPage ( $condition );
	}
	public function assertElementIsVisibleOnPageById($elementID, $sleep = 2) {
		$this->waitForLoad ( function () use(&$elementID) {
			$elements = $this->getSession ()->getPage ()->findAll ( 'css', '#' . $elementID );
			if ($elements !== null) {
				foreach ( $elements as $element )
					if ($element->isVisible ())
						return true;
				return false;
			}
		}, $sleep );
	}
	
	/**
	 * @Then a caixa de texto ":arg1" deve conter ":arg2"
	 */
	public function assertTextboxContainsText($labelForTextbox, $textToVerify) {
		$textbox = $this->getElementByLabelText ( $labelForTextbox );
		$textboxId = $textbox->getAttribute ( 'id' );
		$this->assertFieldContains ( $textboxId, $textToVerify );
	}
	public function getElementByLabelText($labelForElement) {
		$element = false;
		$this->waitForLoad ( function () use(&$labelForElement, &$element) {
			$this->assertElementIsOnPageByTagName ( 'label' );
			$labelElements = $this->getSession ()->getPage ()->findAll ( 'css', 'label' );
			foreach ( $labelElements as $label ) {
				$this->assertElementIsOnPageByXpath ( $label->getXpath () );
				if ($labelForElement == $label->getText ()) {
					$forAttribute = $label->getAttribute ( 'for' );
					$element = $this->getSession ()->getPage ()->find ( 'css', '#' . $forAttribute );
					return true;
				}
			}
			return false;
		} );
		if (! $element)
			throw new Exception ( "Erro ao processar a label '" . $labelForElement . "'" );
		return $element;
	}
	public function clickElementByLabelText($label, $typeLabel) {
		$element = $this->getSession ()->getPage ()->findField ( $label );
		
		if (null === $element)
			throw new Exception ( "Erro ao encontrar o elemento o $typeLabel que possui o texto " . $label );
		
		$value = $element->getAttribute ( 'value' );
		$this->getSession ()->getDriver ()->click ( $element->getXPath () );
		return true;
	}
}