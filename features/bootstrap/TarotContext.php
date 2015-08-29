<?php
use Behat\Behat\Context\Context;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;

/**
 * Tarot context.
 */
class TarotContext extends PersonareContext
{

    /**
    * Verifica se o usuário jogou o tarot com sucesso.
    * @Then vou para meu jogo
    */
    public function seeGameResult()
    {
    	$this->assertElementOnPageById("psr-widget-pr-header"); 
    	$this->assertResponseContains('<p class="periodo-do-jogo">Período do Jogo: <span class="data">');
    }

    /**
    *@When clico na carta ":arg1"
    */
    public function selectCard($cardNumber)
    {
    	$this->assertElementOnPageByQuerySelector("#tarot-deck.tarot-baralho.tarot-carta-hover"); 
    	$this->clickLink("carta-".$cardNumber);
    }
}