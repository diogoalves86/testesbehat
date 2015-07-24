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
        $this->clickLink("psr-cart-step-2");
        $this->clickLink("psr-cart-payment-option-".$row['codigoTipoPagamento']);
        $this->assertElementIsVisibleOnPageById('psr-cart-form-credit-card-payment');

        if($this->isVisibleProcessedElement){
          $this->selectOption("rbPaymentTimes", $row['codigoNumeroParcelas']);
          $this->fillField("nome_cartao", $row['nome']);
          $this->fillField("numero_cartao", $row['numeroCartao']);
          $this->fillField("codico_seguranca", $row['numeroCartao']);
          $this->selectOption("ddValidityMonth", $row['mesValidadeCartao']);
          $this->selectOption("ddValidityYear", $row['anoValidadeCartao']);
          $this->checkOption("cbDataIsOK");
          $this->pressButton("save-credit-cart-button");

          $this->assertElementIsVisibleOnPageById('psr-cart-feedback-payment');

          if(!$this->isVisibleProcessedElement)
            throw new Exception("Erro ao processar elemento");

        }
      }
    } catch (Exception $e) {
      throw new Exception('Erro ao comprar o produto. \n '.$e->getMessage());
    }
  }

  /**
  *@And verifico se o produto :arg1 foi adicionado
  */
  public function checkProductOnCart($productName)
  {
        $this->assertElementIsOnPageById("");
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
}