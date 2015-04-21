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
            $this->assertResponseContains('<p class="periodo-do-jogo">Período do Jogo: <span class="data">20/04/2015 a 20/05/2015</span></p>');
            
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
			$this->getSession()->getDriver()->executeScript("
				window.onbeforeunload = null;
				LoveTarotGame.save();
			");
			//Aguarda até que os dados sejam postados e seja trazida a resposta.
            //$this->waitForAct(15);
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
			$this->getSession()->getDriver()->executeScript("
				objTarot.changeStep(2,'#ta-parte-');
				objTarot.animationCompressionGame(1, '.frases-pt', 5300, 3, '.ta-start-game');
			");
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
			$this->getSession()->getDriver()->executeScript("
				Profile.select(10);
			");
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
			for ($i=1; $i <= 6; $i++) { 
				$this->clickLink('carta-2'.$i);
				// Aguarda a animação carregar
				$this->waitForAct(3);
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
			$this->getSession()->getDriver()->executeScript("
				objTarot.loadGame(3,'#ta-parte-',$(this));
			");
			// Aguarda até a animação do embaralhar das cartas
			$this->waitForAct(15);
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
			$this->getSession()->getDriver()->executeScript("
				document.getElementsByName('ta-choice')[0].setAttribute('checked','true');
			");
		}
		catch (Exception $e) {
			throw new Exception("Erro ao selecionar a pessoa para o futuro afetivo. \n ".$e->getMessage());
		}
	}
}
