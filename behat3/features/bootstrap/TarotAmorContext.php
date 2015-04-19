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
class TarotAmorContext extends PersonareContext implements Context
{
	/**
	* @When clico em "Leia o resultado"
	*/
	public function saveGame()
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				window.onbeforeunload = null;
				LoveTarotGame.save();
			");
		} catch (Exception $e) {
			throw new Exception("Erro ao salvar o produto. \n".$e->getMessage());
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
	* @Given seleciono revelar meu futuro afetivo
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

