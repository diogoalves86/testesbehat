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
	* @Then o nome preenchido no formulário deverá ser :arg1
	*/
	public function checkPlayerName($playerName)
	{
		try {
            $this->assertFieldContains("tarot-nome-jogador", $playerName);
        } catch (Exception $e) {
            throw new Exception('Erro ao verificar o nome do jogador.\n '.$e->getMessage());
        }
	}

	/**
    * Verifica se o usuário jogou o tarot com sucesso.
    * @Then vou para meu jogo 
    */
    public function seeGameResult()
    {
        try {
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
			$this->processElementVisibility("ta-close-game");
			if (!$this->isVisibleProcessedElement)
				throw new Exception("Erro ao processar elemento!");
				
			$this->pressButton('ta-close-game');
		} catch (Exception $e) {
			throw new Exception("Erro ao salvar o produto. \n".$e->getMessage());
		}
	}

	/**
	* @When clico em "Iniciar"
	*/
	public function startGame()
	{
		try {
			$this->proccessElementById("psr-usurio-assinatura");
			if ($this->isReadyProcessedElement)
       			$this->pressButton("psr-signature-separate-play");

       		$this->clickLink("ta-avancar-pt1");
        } catch (Exception $e) {
            throw new Exception('Erro ao iniciar o jogo.\n'.$e->getMessage());
        }
	}
	/**
	* @When clico em "Continuar"
	*/
	public function loadPhrases()
	{
		try {
			$this->processElementVisibility("psr-ta-load-phrases");
			if (!$this->isVisibleProcessedElement)
				throw new Exception("Erro ao processar elemento!");
				
			$this->clickLink("psr-ta-load-phrases");
			
		} catch (Exception $e) {
			throw new Exception("Erro ao carregar as frases para o novo produto. \n".$e->getMessage());
		}
	}

	/**
	* @When sorteio as cartas
	*/
	public function sortCards()
	{
		try {
			$this->processElementVisibility("carta-78");
			if (!$this->isVisibleProcessedElement)
				throw new Exception("Erro ao processar elemento!");
			for ($i=1; $i <= 6; $i++){					
				$this->clickLink("carta-2".$i);
			}
		} catch (Exception $e) {
			throw new Exception("Erro ao sortear as cartas. \n ".$e->getMessage());
		}
	}

	public function isCardsSorted()
	{
		try {
			
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
			$this->processElementVisibility("psr-ta-sort-cards");
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
			$this->processElementVisibility("psr-ta-choice-option-1");
			if (!$this->isVisibleProcessedElement)
				throw new Exception("Erro ao processar elemento!");
				
			$this->checkRadioButton("psr-ta-choice-option-1");
		}
		catch (Exception $e) {
			throw new Exception("Erro ao selecionar a pessoa para o futuro afetivo. \n ".$e->getMessage());
		}
	}
}