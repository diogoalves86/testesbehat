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
	* @Given avanço para o passo :arg1 da compra
	*/
	public function cartNextStep($cartStep)
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				Cart.goToStep(".$cartStep.");
			");
		} catch (Exception $e) {
			throw new Exception('Erro ao avançar para o passo '.$cartStep.' do carrinho. \n '.$e->getMessage());
		}
	}

	/**
	* @Given escolho o número de parcelas de identificação :arg1
	*/
	public function setPaymentTimes($paymentTimesOption)
	{
		# code...
	}

	/**
	* @Given escolho a forma de pagamento de identificação :arg1
	*/
	public function setPaymentOption($paymentOption)
	{
		try {
			$this->getSession()->getDriver()->executeScript("
				SetPaymentOption(".$paymentOption.")
			");
		} catch (Exception $e) {
			throw new Exception('Erro ao selecionar o tipo de pagamento.'.$e->getMessage());	
		}
	}
}

