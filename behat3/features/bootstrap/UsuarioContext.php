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
 * Usuario context.
 */
class UsuarioContext extends PersonareContext implements Context
{

    /**
    * @Then envio o formulário de cadastro
    */
    public function submitNewUserForm()
    {
        try {
            $this->getSession()->getDriver()->executeScript("
                Register.addUser('FormRegister');
            ");
        } catch (Exception $e) {
            throw new Exception("Ocorreu um erro ao cadastrar o usuário. \n".$e->getMessage());
        }
    }

    /**
    * @When preencho o formulário de cadastro com os seguintes dados:
    */
    public function insertNewUser(TableNode $table)
    {
        try {
            foreach($table as $row){
                $this->fillField("txName", $row["nome"]);
                $this->selectOption("ddGender", $row["sexoValor"]);
                $this->selectOption("ddBirthDateDay", $row["dia"]);
                $this->selectOption("ddBirthDateMonth", $row["mês"]);
                $this->selectOption("ddBirthDateYear", $row["ano"]);
                $this->selectOption("ddBirthTimeHour", $row["hora"]);
                $this->selectOption("ddBirthTimeMinute", $row["minuto"]);
                $this->fillField("txCityName", $row["cidade"]);
                $this->fillField("txEmail", $row["email"]);
                $this->fillField("pwPassword", $row["senha"]);
                $this->fillField("Confirm_pwPassword", $row["confirmacaoSenha"]);
            }
        } catch (Exception $e) {
            throw new Exception("Ocorreu um erro ao preencher o formulário de cadastro do usuário. \n".$e->getMessage());
        }
    }
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
}
