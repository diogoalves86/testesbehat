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
 * TarotDoDia context.
 */
class TarotDoDiaContext extends MinkContext
{    
    /**
    * @Then jogo o tarot
    */
    public function startDailyTarot()
    {
        try {
            $this->getSession()->getDriver()->executeScript("
                objTarot.saveGame();
            ");
            
        } catch (Exception $e) {
            throw new Exception("Erro ao jogar Tarot.\n ".$e->getMessage());
            
        }
    }

    /**
    * Verifica se o usuário jogou o tarot com sucesso.
    * @Then vejo o jogo de :arg1 
    */
    public function seeResultGame($player)
    {
        try {
            $this->visit("/tarot/jogar");
            $this->assertResponseContains('<a href="/logout-tarot-do-dia">Saia aqui</a>');
            
        } catch (Exception $e) {
            throw new Exception("Erro ao verificar o jogo de tarot.\n ".$e->getMessage());
        }
    }
}