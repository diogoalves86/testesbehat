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
}