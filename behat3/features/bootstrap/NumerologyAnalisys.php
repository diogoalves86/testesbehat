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
class NumerologyAnalisysContext extends PersonareContext implements Context
{
	/**
	*@When clico em "ler uma amostra grátis da análise" 
	*/
	public function newMini()
	{
		$this->clickLink("psr-product-new-mini");
	}
	/**
	*@Then seleciono o perfil com os seguintes dados:
	*/
	public function selectProfile(TableNode $table)
	{
		try {
			$userDescription = "%s - %s/%s/%s";
			foreach ($table as $row) {
				$userProfile = sprintf($userDescription, $row['nome'], $row['dia'], $row['mes'], $row['ano']);
				$this->selectOption($userProfile);
			}
		} catch (Exception $e) {
			throw new Exception("Error ao selecionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}

	/**
	*@When preencho a pessoa ser analisada com os seguintes dados:
	*/
	public function fillFormToSaveProfile(TableNode $table)
	{
		if($this->isReadyElementById("Name", 2000)){
			foreach ($table as $row) {
				$this->fillField("Name", $row['nome']);
				$this->selectOption("MapaNum_dataDay", $row['dia']);
				$this->fillField("MapaNum_dataMonth", $row['mes']);
				$this->fillField("MapaNum_dataYear", $row['ano']);
				$this->fillField("MapaYear_data", $row['anoAnalisado']);
			}
		}
	}

	/**
	*@When clico em "Selecionar"
	*/
	public function selectProfileClick()
	{
		try {
			$this->clickLink("psr-mini-mna-select-profile");
		} catch (Exception $e) {
			throw new Exception("Error ao selecionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}

	/**
	*@Then vou para meu mapa
	*/
	public function checkGameResult()
	{
		try {
			if($this->isReadyElementById("psr-mini-mna-game-username", 2000))
				return true;
		} catch (Exception $e) {
			throw new Exception("Error ao selecionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}
}
