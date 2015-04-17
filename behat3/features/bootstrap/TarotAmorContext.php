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
 
/**
 * TarotAmor context.
 */
class TarotAmorContext extends PersonareContext implements Context
{
	/**
	* @When clico em ler uma amostra grátis
	*/
	public function selectProfile()
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				Profile.select(10);
			");
		} catch (Exception $e) {
			throw new Exception("Não foi realizar o selecionar o perfil para jogar o TarotAmor .\nInformações detalhadas do erro: ".$e->getMessage());   
		}
	}
}

