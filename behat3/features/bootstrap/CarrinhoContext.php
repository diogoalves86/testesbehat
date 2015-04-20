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
 * Carrinho context.
 */
class CarrinhoContext extends PersonareContext implements Context
{
	/**
	* @Then clico em "FINALIZAR COMPRA"
	*/
	public function saveCreditCard()
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				SaveCreditCard();
			");
		} catch (Exception $e) {
			throw new Exception('Erro ao finalizar a compra. \n '.$e->getMessage());
		}
	}

	/**
	* @Given clico em "PROSSEGUIR COM A COMPRA"
	*/
	public function cartNextStep()
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				Cart.goToStep(2);
			");
		} catch (Exception $e) {
			throw new Exception('Erro ao avançar para o passo 2 do carrinho. \n '.$e->getMessage());
		}
	}
	/**
	* @Given escolho a forma de pagamento de identificação :arg1
	*/
	public function setPaymentOption($paymentOption)
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				SetPaymentOption(".$paymentOption.");
			");
		} catch (Exception $e) {
			throw new Exception('Erro ao selecionar o tipo de pagamento.'.$e->getMessage());	
		}
	}
}

