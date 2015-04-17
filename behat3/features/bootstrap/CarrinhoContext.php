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
	* @Given estou logado no sistema com o usuário :arg1 e a senha :arg2
	*/
	public function doLoginForTest($username, $password)
	{
		$this->userLogged($username, $password);
	}
}

