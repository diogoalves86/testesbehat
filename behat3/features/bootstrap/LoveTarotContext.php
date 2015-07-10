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
class LoveTarotContext extends MiniProductContext implements Context
{
	/**
    * Verifica se o usuário jogou o tarot com sucesso.
    * @Then vou para meu jogo 
    */
    public function seeGameResult()
    {
        try {
        	$this->assertElementIsOnPageById("psr-widget-pr-header");
        	if (!$this->isReadyProcessedElement)
        		throw new Exception("Erro ao processar elemento!");

            $this->assertResponseContains('<p class="periodo-do-jogo">Período do Jogo: <span class="data">');
            
        } catch (Exception $e) {
            throw new Exception('Erro ao verificar o jogo.\n '.$e->getMessage());
        }
    }

	/**
	* @Then clico em "Leia o resultado"
	*/
	public function saveGame()
	{
		try {	
			$this->assertElementIsVisibleOnPageById("ta-close-game");
			if (!$this->isVisibleProcessedElement)
				throw new Exception("Erro ao processar elemento!");
				
			$this->pressButton('ta-close-game');
		} catch (Exception $e) {
			throw new Exception("Erro ao salvar o produto. \n".$e->getMessage());
		}
	}

	/**
	* @When sorteio as cartas
	*/
	public function sortCards()
	{
		try {
			$this->assertElementIsOnPageByQuerySelector("#tarot-deck.tarot-baralho.tarot-carta-hover");
			if (!$this->isReadyProcessedElement)
				throw new Exception("Erro ao processar elemento!");
			for ($i=1; $i <= 6; $i++){
				$this->clickLink("carta-2".$i);
				// Verifica se a carta foi realmente clicada
				$this->assertElementIsOnPageByQuerySelector("#carta-flip.hide");
				if(!$this->isReadyProcessedElement)
					throw new Exception("Erro ao processar elemento!");
			}
		} catch (Exception $e) {
			throw new Exception("Erro ao sortear as cartas. \n ".$e->getMessage());
		}
	}

	/**
	* @When clico em "Embaralhar"
	*/
	public function prepareGame()
	{
		try {
			$this->assertElementIsVisibleOnPageById("psr-ta-sort-cards");
			if (!$this->isVisibleProcessedElement)
					throw new Exception("Erro ao processar elemento!");
			
			$this->clickLink("psr-ta-sort-cards");
		} catch (Exception $e) {
			throw new Exception("Erro ao embaralhar as cartas. \n ".$e->getMessage());
		}
	}

	/**
	* @Then seleciono revelar meu futuro afetivo
	*/
	public function checkTAPhrases()
	{
		try {
			$this->assertElementIsVisibleOnPageById("psr-ta-choice-option-1");
			if (!$this->isVisibleProcessedElement)
				throw new Exception("Erro ao processar elemento!");
				
			$this->checkRadioButton("psr-ta-choice-option-1");
		}
		catch (Exception $e) {
			throw new Exception("Erro ao selecionar a pessoa para o futuro afetivo. \n ".$e->getMessage());
		}
	}
}