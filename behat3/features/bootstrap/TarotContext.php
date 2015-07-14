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
class TarotContext extends PersonareContext implements Context
{
    /**
    *@When clico na carta ":arg1"
    */
    public function selectCard($cardNumber)
    {
        try {
            $this->assertElementIsOnPageByQuerySelector("#tarot-deck.tarot-baralho.tarot-carta-hover");
            if (!$this->isReadyProcessedElement)
                throw new Exception("Erro ao processar elemento!");
            $this->clickLink("carta-".$cardNumber);

        } catch (Exception $e) {
            throw new Exception('Erro ao selecionar carta.\n '.$e->getMessage());
        }
    }
}