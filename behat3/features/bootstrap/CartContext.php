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
 * Cart context.
 */
class CartContext extends PersonareContext implements Context
{

	/**
	* @When compro este produto com os seguintes dados: 
	*/
	public function buyNewProduct(TableNode $table)
	{
		try {
			foreach ($table as $row) {
				$this->visit("/carrinho");
				$this->getSession()->getDriver()->executeScript("Cart.goToStep(2);");
				$this->getSession()->getDriver()->executeScript("SetPaymentOption(".$row['codigoTipoPagamento'].");");
				// Aguarda 5 segundos para carregar o formulário correspondente.
				$this->waitForAct(5);
				$this->selectOption("rbPaymentTimes", $row['codigoNumeroParcelas']);
				$this->fillField("nome_cartao", $row['nome']);
				$this->fillField("numero_cartao", $row['numeroCartao']);
				$this->fillField("codico_seguranca", $row['numeroCartao']);
				$this->selectOption("ddValidityMonth", $row['mesValidadeCartao']);
				$this->selectOption("ddValidityYear", $row['anoValidadeCartao']);
				$this->checkOption("cbDataIsOK");
				$this->pressButton("save-credit-cart-button");
			}
		} catch (Exception $e) {
			throw new Exception('Erro ao comprar o produto. \n '.$e->getMessage());
		}	
	}

	/**
	* @When adiciono o produto de código :arg1 ao carrinho
	*/
	public function addProductToCart($productCode)
	{
		try {
			$this->visit("/carrinho/adicionar/".$productCode);
		} catch (Exception $e) {
			throw new Exception('Erro ao adicionar produto ao carrinho. \n '.$e->getMessage());
		}
	}
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
}