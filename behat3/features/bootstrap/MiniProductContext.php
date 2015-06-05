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
class MiniProductContext extends PersonareContext implements Context
{
	/**
    *@When clico em "ler uma amostra grátis da análise"
    */
    public function generateNewMini()
    {
        try {
            $this->clickLink("psr-product-new-mini");
        } catch (Exception $e) {
            throw new Exception("Erro ao clicar para ler análise Mini. \n".$e->getMessage());
            
        }
    }

    /**
	*@Then clico em "Selecionar"
	*/
	public function selectProfile()
	{
		try {
			$this->proccessElementById("psr-mini-mna-select-profile");
			if(!$this->isReadyProcessedElement)
				throw new Exception("Erro ao processar elemento!");

			$this->clickLink("psr-mini-mna-select-profile");
		} catch (Exception $e) {
			throw new Exception("Error ao selecionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}

    /**
	*@When seleciono a opção “Adicionar novo perfil”
	*/
	public function selectAddNewProfile()
	{
		try {
			$this->proccessElementById("ddProfile");
			if(!$this->isReadyProcessedElement)
				throw new Exception("Erro ao processar elemento!");
				
			$this->selectOption("ddProfile", "AddProfile");
		} catch (Exception $e) {
			throw new Exception("Error ao adicionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}


	/**
	*@Then seleciono o perfil com os seguintes dados:
	*/
	public function selectComboProfile(TableNode $table)
	{
		try {
			$this->proccessElementById("ddProfile");
			if(!$this->isReadyProcessedElement)
				throw new Exception("Erro ao processar elemento!");

			$userDescription = "%s - %s/%s/%s";
			foreach ($table as $row) {
				$userProfile = sprintf($userDescription, $row['nome'], $row['dia'], $row['mes'], $row['ano']);
				$this->selectOption('ddProfile', $userProfile);
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
		$this->proccessElementById("Name");
		if(!$this->isReadyProcessedElement)
			throw new Exception("Erro ao processar elemento!");
			
		foreach ($table as $row) {
			$this->fillField("Name", $row['nome']);
			$this->selectOption("MapaNum_dataDay", $row['dia']);
			$this->fillField("MapaNum_dataMonth", $row['mes']);
			$this->fillField("MapaNum_dataYear", $row['ano']);
			$this->selectOption("MapaYear_data", $row['anoAnalisado']);
		}
	}

	/**
	*@Then vou para meu mapa
	*/
	public function checkGameResult()
	{
		try {
			$this->proccessElementById("psr-widget-pr-header");
			if(!$this->isReadyProcessedElement)
				throw new Exception("Erro ao processar elemento!");
				
		} catch (Exception $e) {
			throw new Exception("Error ao selecionar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}

	/**
	*@Then clico em “Salvar”
	*/
	public function saveNewProfile()
	{
		try {
			$this->clickLink("psr-mini-add-profile");
		} catch (Exception $e) {
			throw new Exception("Error ao salvar perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}

	/**
	*@When adiciono um novo perfil com os seguintes dados:
	*/
	public function addNewProfile(TableNode $table)
	{
		try {
			$this->proccessElementById("Name");
			if(!$this->isReadyProcessedElement)
				throw new Exception("Erro ao processar elemento!");
			
			foreach ($table as $row) {
				$this->fillField("Name", $row['nome']);
				$this->selectOption("DateDay", $row['dia']);
				$this->fillField("DateMonth", $row['mes']);
				$this->fillField("DateYear", $row['ano']);
				$this->fillField("Gender", $row['sexoValor']);
				
				if($row['possuiHoraNascimento'] !== "sim"){
					$this->fillField("ddBirthTimeHour", $row['horaNascimento']);
					$this->fillField("ddBirthTimeMinute", $row['minutoNascimento']);
				}
				else
					$this->checkOption("cbDontKnowBirthTime");
				
				$this->prepareCity("txCityName", $row['cidade']);
			}
		} catch (Exception $e) {
			throw new Exception("Error ao adicionar o perfil do usuário. \n Informações detalhadas do erro:\n".$e->getMessage());
		}
	}
}