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
class LoveTarotContext extends PersonareContext implements Context
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
			if ($this->isVisibleElement("psr-ta-load-phrases", 3000))
				$this->clickLink("psr-ta-load-phrases");
			
		} catch (Exception $e) {
			throw new Exception("Erro ao carregar as frases para o novo produto. \n".$e->getMessage());
		}
	}

	/**
	* @When clico em "ler uma amostra grátis"
	*/
	public function profileSelect()
	{
		try {
			$this->clickLink("psr-product-new-mini");

		} catch (Exception $e) {
			throw new Exception("Erro ao Clicar em ler uma amostra grátis. \n".$e->getMessage());
		}
	}

	/**
	* @When sorteio as cartas
	*/
	public function sortCards()
	{
		try {
			for ($i=1; $i <= 6; $i++){
				if ($this->isVisibleElement($this->cssID, 3000))
					$this->clickLink("carta-2".$i);
				
			}
		} catch (Exception $e) {
			throw new Exception("Erro ao sortear as cartas. \n ".$e->getMessage());
		}
	}

	/**
	* @When embaralho as cartas
	*/
	public function prepareGame()
	{
		try {
			if ($this->isVisibleElement("psr-ta-sort-cards", 3000))
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
			if ($this->isVisibleElement("psr-ta-choice-option-1", 2000))
				$this->checkRadioButton("psr-ta-choice-option-1");
		}
		catch (Exception $e) {
			throw new Exception("Erro ao selecionar a pessoa para o futuro afetivo. \n ".$e->getMessage());
		}
	}
}