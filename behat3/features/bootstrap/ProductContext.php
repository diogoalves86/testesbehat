<?php
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Hook\Scope\BeforeStepScope;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Context;

/**
* Classe responsável pelo contexto geral do Personare
*/
class ProductContext extends PersonareContext implements Context
{
	
	/**
	*@Then verifico resultado do :arg1
	*/
	public function checkGameResult($productName)
	{
		try {
			$this->assertElementIsOnPageByQuerySelector("#psr-widget-header h1");
			if(!$this->isReadyProcessedElement)
				throw new Exception("Erro ao processar elemento!");

		} catch (Exception $e) {
			throw new Exception("Error ao selecionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}

	/**
	*@When adiciono um novo perfil com os seguintes dados:
	*/
	// public function addNewProfile(TableNode $table)
	// {
	// 	try {
	// 		$this->assertElementIsOnPageById("Name");
	// 		if(!$this->isReadyProcessedElement)
	// 			throw new Exception("Erro ao processar elemento!");

	// 		foreach ($table as $row) {
	// 			$this->fillField("Name", $row['nome']);
	// 			$this->selectOption("DateDay", $row['dia']);
	// 			$this->fillField("DateMonth", $row['mes']);
	// 			$this->fillField("DateYear", $row['ano']);
	// 			$this->fillField("Gender", $row['sexoValor']);

	// 			if($row['possuiHoraNascimento'] !== "sim"){
	// 				$this->fillField("ddBirthTimeHour", $row['horaNascimento']);
	// 				$this->fillField("ddBirthTimeMinute", $row['minutoNascimento']);
	// 			}
	// 			else
	// 				$this->checkOption("cbDontKnowBirthTime");

	// 			$this->prepareCity("txCityName", $row['cidade']);
	// 		}
	// 	} catch (Exception $e) {
	// 		throw new Exception("Error ao adicionar o perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
	// 	}
	// }
}