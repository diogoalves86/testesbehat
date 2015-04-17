<?php 
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
 
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Context;

/**
* Classe responsável pelo contexto geral do Personare
*/
class PersonareContext extends MinkContext implements Context
{
	
    /*
    * Este método tem o papel de logar o usuário no caso de testes que precisem do usuário logado.
    * Por exemplo, os testes de carrinho. 
    */
    public function userLogged($username, $password)
    {
        try {
            $this->visit("/login");
            $this->fillField("txEmail", $username);
            $this->fillField("pwPassword", $password);
            $this->getSession()->getDriver()->executeScript("
                    Login.efetuaLogin('FormPOPLogin');
            ");
        } catch (Exception $e) {
            throw new Exception("Não foi realizar o login do usuário ".$username.".\nInformações detalhadas do erro: ".$e->getMessage());   
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



    /**
     * Seleciona uma das opções da combobox passado por parâmetro
     * @And seleciono a opção :arg1 de :arg2
     */
    public function selectOptionFromCombo($select, $value)
    {
        try {
            $this->selectOption($select, $value);
            
        } catch (Exception $e) {
            throw new Exception("Ocorreu um erro fatal ao selecionar o valor da comboBox.\nInformações detalhadas do erro: ".$e->getMessage()."\n");      
        }
    }
}