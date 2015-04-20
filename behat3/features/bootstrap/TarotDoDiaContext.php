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
class TarotDoDiaContext extends PersonareContext implements Context
{
    /**
    * Embaralha as cartas para o jogo
    * @Then embaralho as cartas do jogo
    */
    public function prepareGame()
    {
        try {
            $this->clickLink("daily-tarot-start-game");
            //Aguarda a animação do deck para finalizar o processo de embaralhamento.
            $this->waitForAct(15);

        } catch (Exception $e) {
            throw new Exception("Erro ao embaralhar as cartas.\n ".$e->getMessage());
        }
    }

    /**
    * Joga o Tarot propriamente dito.
    * @Then jogo o tarot
    */
    public function saveGame()
    {
        try {
            $this->getSession()->getDriver()->executeScript("
                window.onbeforeunload = null;
                DailyTarotGame.saveGame()
            ");
            
            //Aguarda até que os dados sejam postados e seja trazida a resposta.
            $this->waitForAct(15);
            
        } catch (Exception $e) {
            throw new Exception("Erro ao jogar Tarot.\n ".$e->getMessage());
        }
    }

    /**
    * Verifica se o usuário jogou o tarot com sucesso.
    * @Then vou para o jogo de :arg1 
    */
    public function seeGameResult($playerName)
    {
        try {
            $this->assertResponseContains("<strong>Jogo de ".$playerName."</strong>");
            
        } catch (Exception $e) {
            throw new Exception('Erro ao verificar o jogo do "'.$playerName.'".\n '.$e->getMessage());
        }
    }

    /**
    * @Then preencho o nome do jogador com :arg1
    */
    public function setPlayerName($playerName)
    {
        try {
            $this->fillField("tarot-nome-jogador", $playerName);
        } catch (Exception $e) {
            throw new Exception('Erro ao alterar o nome do jogador para iniciar o jogo.\n '.$e->getMessage());   
        }
    }
}