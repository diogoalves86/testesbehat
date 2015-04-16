<?php
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
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
class UsuarioContext extends MinkContext implements Context
{
    /**
     * Efetua login do usuário.
     * @Then faço login 
    */
    public function doLogin()
    {
        try {
            $this->getSession()->getDriver()->executeScript("
                    Login.efetuaLogin('FormPOPLogin');
            ");
        } catch (Exception $e) {
            throw new Exception("Ocorreu um erro fatal ao efetuar o login.\n\n\n Informações detalhadas do erro: ".$e->getMessage()."\n\n\n");
        }
    }

    /**
    * Verifica se o usuário atual está logado.
    * @Then verifico se estou logado
    */
    public function verifyLogin()
    {
        try {
            $this->visit("/astrologia/horoscopo");    
            $this->assertResponseContains('<a href="/logout">Desconectar</a>');
                
        } catch (Exception $e) {
            throw new Exception("Ocorreu um erro fatal ao verificar o login.\nInformações detalhadas do erro: ".$e->getMessage()."\n");   
        }
    }

    /**
     * @Given seleciono a opção :arg1 da combo :arg2
     */
    public function selectOptionFromCombo($select, $value)
    {
        try {
            $this->selectFieldOption($select, $value);
            
        } catch (Exception $e) {
            throw new Exception("Ocorreu um erro fatal ao selecionar o valor da comboBox.\nInformações detalhadas do erro: ".$e->getMessage()."\n");      
        }
    }

    /**
     * @Given preencho com :arg1 o campo :arg2
     */
    public function fillFieldWithSelector($valor, $campo)
    {
        try {
            $this->fillField($campo, $valor);
        } catch (Exception $e) {
            throw new Exception("Não foi possível preencher o campo ".$campo.".\nInformações detalhadas do erro: ".$e->getMessage());
        }
    }
}
