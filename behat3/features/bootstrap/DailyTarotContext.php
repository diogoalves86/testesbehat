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
 * TarotDoDia context.
 */
class DailyTarotContext extends TarotContext
{

    /**
    * Verifica se o usuário jogou o tarot com sucesso.
    * @Then vou para o jogo de :arg1
    */
    public function seeGameResult($playerName)
    {
    	$this->assertElementOnPageById("explicacao-td");
    	$this->assertResponseContains("<strong>Jogo de ".$playerName."</strong>");
    }
}