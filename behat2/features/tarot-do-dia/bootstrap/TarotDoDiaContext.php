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
    // /**
    //  * @Given /^Estou no contexto "([^"]*)"$/
    //  */
    // public function getSubcontextByClassName($className)
    // {
    //     $className.= "Context";
    //     // if($className === get_class($this))
    //     //     return;
    //     // else if (class_exists($className))
    //     //     $this->useContext($className, new $className($this));
    //     // else
    //     //     throw new Exception("O contexto escolhido não existe! Tente novamente.");
    // }
}