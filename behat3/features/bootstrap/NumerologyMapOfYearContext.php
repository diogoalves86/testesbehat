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
class NumerologyMapOfYearContext extends PersonareContext implements Context
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
}
