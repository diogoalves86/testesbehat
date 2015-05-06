<?php 
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
 
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Context;

class JavascriptContext extends PersonareContext implements Context
{
	public function setIdForDOMElement($cssSelector, $newId)
	{
		try {
			//Atribui um ID ao elemento que ainda não possui identificação e posteriormente poder acessá-lo.
			 $this->getSession()->getDriver()->executeScript("
			 	var element = document.querySelector('".$cssSelector."');
			 	element.setAttribute('id','".$newId."');
			");
		} catch (Exception $e) {
			throw new Exception("Erro ao alterar o id para o elemento. \n".$e->getMessage());
		}
	}
}