<?php
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Hook\Scope\BeforeStepScope;
use Behat\Behat\Hook\Scope\AfterFeatureScope;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Context;

/**
* Classe responsável pelo contexto geral do Personare
*/
class PersonareContext extends MinkGenericExtensionContext
{
    /**
    * @Given que estou logado no sistema com o usuário :arg1 e a senha :arg2
    */
    public function userLogged($username, $password)
    {
        try {
            $this->visit("/login?ReturnToURL=L2FzdHJvbG9naWEvaG9yb3Njb3Bv");
            $this->fillField("txEmail", $username);
            $this->fillField("pwPassword", $password);
            $this->pressButton("psr-user-login");
            $this->assertElementIsVisibleOnPageById('psr-user-navbar-logged');

            if(!$this->isVisibleProcessedElement)
                throw new Exception("Erro ao processar elemento!");

        } catch (Exception $e) {
            throw new Exception("Não foi possível realizar o login do usuário ".$username.".\nInformações detalhadas do erro: ".$e->getMessage());
        }
    }
}