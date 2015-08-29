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
   *@Given que estou sem produtos no carrinho
   */
  public function clearCart()
  {
  	$cartItems = $this->getLinksToDeleteAllProducts ();

  	$this->assertElementOnPageByXpath($cartItems[0]->getXpath());
  	foreach($cartItems as $cartItem)
  	{
  		var_dump($cartItem->getText());
  		$cartItem->click();
  		$this->assertElementOnPageByXpath($cartItem->getXpath());
  	}
  }
/**
	 * 
	 */private function getLinksToDeleteAllProducts() {
		$cartItems = $this->waitForLoad(function(){
			return $this->getSession()->getPage()->findAll("css", "#psr-lista-produtos .td_remove a");
		});
		var_dump($cartItems->getText()); exit;
		return $cartItems;
	}

  
  /**
  * @When adiciono o produto de código :arg1 ao carrinho
  */
  public function addProductToCart($productCode)
  {
      $this->visit("/carrinho/adicionar/".$productCode);
  }
}