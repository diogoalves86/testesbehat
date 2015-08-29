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
class CartContext extends PersonareContext
{
  /**
  *@Then verifico se o produto :arg1 foi adicionado
  */
  public function checkFirstProductOnCartByName($productName)
  {
        $element = $this->getSession()->getPage()->find("css", "#psr-lista-produtos tr td.text_product h3");
        if ( !is_object($element ) )
        	throw new Exception("Nao existe nenhum  produto  no carrinho");
        else if ($element->getText() !== $productName)
        	throw new Exception("O produto {$productName} nao foi encontrado como primeiro item do carrinho \n O produto {$element->getText()} foi encontrado");

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