<?php 
use Behat\Behat\Context\Context;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
 
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;
class NumerologyAnalisysContext extends MiniProductContext implements Context
{

	/**
	*@When clico em "Selecionar"
	*/
	public function selectProfileClick()
	{
		try {
			$this->clickLink("psr-mini-select-profile");
		} catch (Exception $e) {
			throw new Exception("Error ao selecionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}
}
