<?php
 
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
 
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;
 
/**
 * CadastroUsuario context.
 */
class CadastroUsuarioContext extends BehatContext
{
	private $parentContext;

	public function __construct($FeatureInstance)
	{
		$this->parentContext = $FeatureInstance;
	}
 
 	/**
    * Função sobrescrita do MinkContext
    * @Given /^vou para "(/[^"]*)"
    */
	public function clicarLink($linkID)
	{
		$this->minkContext->clickLink($linkID);
	}



    /**
     * Get Mink session from MinkContext
     */
    public function getSession($name = null)
    {
        return $this->getMainContext()->getSession($name);
    }
 
    /**
     * Write your subcontext methods below.
     * Remember that this class extends BehatContext, not MinkContext
     */


 
}