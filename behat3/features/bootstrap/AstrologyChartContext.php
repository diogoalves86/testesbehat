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

class AstrologyChartContext extends MiniProductContext implements Context
{
	/**
	*@When clico em "Selecionar" no yii
	*/
	/*public function selectProfileClick()
	{
		try {
			$this->clickLink("psr-mini-mna-select-profile-yii");
		} catch (Exception $e) {
			throw new Exception("Error ao selecionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}
	*/
}