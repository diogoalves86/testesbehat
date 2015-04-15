<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * @Given /^digito no campo de ID "([^"]*)" o valor "([^"]*)"$/
     */
    public function digitoNoCampoDeIdOValor2($fieldId, $fieldValue)
    {
        // exit;
        // $handler = new Behat\Mink\Element\NodeElement(null,$this->getSession());
        // $page = $this->getSession()->getPage();
        // $playerNameField = $page->find('xpath', "@tarot-do-dia-parte-2");
        // // $field = $handler->findById($fieldId);
        // var_dump(gettype($playerNameField)); exit; 
        // $output = $handler->fillField((string)$handler->findById($fieldId), $fieldValue);
        
        // $playerNameField->setValue($fieldValue);
        // throw new PendingException();
    }

    /**
     * @Given /^submeto o formulário "([^"]*)"$/
     */
    public function submetoOFormulario($formId)
    {
        $page = $this->getSession()->getPage();
        $element = $page->find('css',"#".$formId." button[type='submit']");
        $element->doubleClick();
        //throw new PendingException();
    }

    /**
    * Função sobrescrita do MinkContext
    * @Given /^sigo o link "(/[^"]*)"
    */
    public function clickLink($linkID)
    {
        $xpath = "descendant-or-self::*[@id = '".$linkID."']";
        // $element = new \Behat\Mink\Element\NodeElement($xpath, $this->getSession());
        $element = new \Behat\Mink\Element\DocumentElement($this->getSession());
        // if (!$element->isVisible()) {
        // }
        if ($linkID == "daily-tarot-close-game") {
            $this->getSession()->evaluateScript(
                '$("#daily-tarot-close-game").attr("disabled","disabled");
                window.onbeforeunload = true;
                DailyTarotGame.saveGame();'
            );
        }
        $element->clickLink($linkID);
        // var_dump($element->getHtml()); exit;
        // $linkID = $this->fixStepArgument($linkID);
        // $this->getSession()->getPage()->clicklinkID($linkID);
      
            
   
            
    }
}
