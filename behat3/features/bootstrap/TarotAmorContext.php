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
	* @And sorteio as cartas
	*/
	public function sortCards()
	{
		try {
			for ($i=0; $i < 6; $i++) { 
				$this->clickLink('carta-2'.$i);
				// Aguarda a animação carregar
				$this->waitForAct(3);
			}
		} catch (Exception $e) {
			throw new Exception("Erro ao sortear as cartas. \n ".$e->getMessage());
		}
	}

	/**
	* @And embaralho as cartas
	*/
	public function prepareGame($value='')
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
	* @And seleciono revelar meu futuro afetivo com :arg1
	*/
	public function checkTAPhrases($personName)
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				objTarot.changeStep(2,'#ta-parte-');
				objTarot.animationCompressionGame(1, '.frases-pt', 5300, 3, '.ta-start-game');
			");
			// Aguarda carregar a animação
			$this->waitForAct(6);
		} catch (Exception $e) {
			throw new Exception("Erro ao selecionar a pessoa para o futuro afetivo. \n ".$e->getMessage());
		}
	}

	/**
	* @When clico em ler uma amostra grátis
	*/
	public function selectProfile()
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				Profile.select(10);
			");
		} catch (Exception $e) {
			throw new Exception("Não foi realizar o selecionar o perfil para jogar o TarotAmor .\nInformações detalhadas do erro: ".$e->getMessage());   
		}
	}
}

