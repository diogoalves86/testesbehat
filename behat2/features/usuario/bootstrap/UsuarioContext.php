<?php 
namespace Behat\Behat\Context;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
 
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;

/**
 * Usuario context.
 */
class UsuarioContext extends MinkContext
{    
    /**
     * @Given /^Eu vou para “\/cadastro"$/
     */
    public function euVouParaCadastro()
    {
        throw new PendingException();
    }

    /**
     * @Given /^eu seleciono “(\d+)” de "([^"]*)"$/
     */
    public function euSelecionoDe($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^eu seleciono  "([^"]*)" de “Gender”$/
     */
    public function euSelecionoDeGender($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^preencho "([^"]*)" com “Rio de Janeiro”$/
     */
    public function preenchoComRioDeJaneiro($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^preencho “E-Mail” com "([^"]*)"$/
     */
    public function preenchoEMailCom($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^preencho “Password” com "([^"]*)"$/
     */
    public function preenchoPasswordCom($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^submeto o formulário "([^"]*)"$/
     */
    public function submetoOFormulario($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^marco “cbReceiveAlerts_(\d+)”$/
     */
    public function marcoCbreceivealerts($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^marco “cbReceiveNews_(\d+)”$/
     */
    public function marcoCbreceivenews($arg1)
    {
        throw new PendingException();
    }

}