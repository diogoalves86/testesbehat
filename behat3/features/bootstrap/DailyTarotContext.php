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
class DailyTarotContext extends PersonareContext implements Context
{

    /**
    * Verifica se o usuário jogou o tarot com sucesso.
    * @Then vou para o jogo de :arg1 
    */
    public function seeGameResult($playerName)
    {
        try {
            $this->assertElementIsOnPageById("explicacao-td");
            if (!$this->isReadyProcessedElement) 
                throw new Exception("Erro ao processar elemento!");
                
            $this->assertResponseContains("<strong>Jogo de ".$playerName."</strong>");
            
        } catch (Exception $e) {
            throw new Exception('Erro ao verificar o jogo do "'.$playerName.'".\n '.$e->getMessage());
        }
    }

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