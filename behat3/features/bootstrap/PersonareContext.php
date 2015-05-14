<?php 
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
 
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Hook\Scope\BeforeStepScope;
use Behat\Behat\Context\Step;
use Behat\Behat\Context\Context;

/**
* Classe responsável pelo contexto geral do Personare
*/
class PersonareContext extends MinkContext implements Context
{
    public $cssID, $currentElement;

    /**
    *@When clico em "ler uma amostra grátis da análise"
    */
    public function generateNewMini()
    {
        try {
            $this->clickLink("psr-product-new-mini");
        } catch (Exception $e) {
            throw new Exception("Erro ao clicar para ler análise Mini. \n".$e->getMessage());
            
        }
    }

    // Espera o elemento estar visível para então poder interagir com ele.
    public function waitForLoad($function)
    {
        while (true)
        {
            try {
                if ($function($this) == true) {
                    return true;
                }
                
            } catch (Exception $e) {
                throw new Exception("Erro ao verificar se o elemento de seletor é visível. \n".$e->getMessage());                
            }
            sleep(1);
        }
    }   

    public function isReadyElementById($elementID, $callBackValue = 1000)
    {
         $this->waitForLoad(function() use(&$elementID, &$callBackValue) {
            $this->getSession()->wait($callBackValue, 'document.getElementById("'.$elementID.'") != null');
            return true;
        });
    }

    public function isReadyElementByCssSelector($cssSelector, $callBackValue)
    {
         $this->waitForLoad(function() use(&$cssSelector, &$callBackValue) {
            $this->getSession()->wait($callBackValue, 'document.querySelector("'.$cssSelector.'") != null');
            return true;
        });
    }

    public function isVisibleElement($elementID, $callBackValue = 1000)
    {
        $this->waitForLoad(function() use(&$elementID, &$callBackValue) {
            $isVisible = $this->getSession()->wait($callBackValue, 'document.getElementById("'.$elementID.'").offsetParent != null');
            return $isVisible == true ? true:false;
        });
    }

	/**
	* @Given aguardo :arg1 segundos
	*/
	public function waitForAct($secondsToWait)
	{
		try {
			$milisecondsToWait = $secondsToWait * 1000;
			$this->getSession()->wait($milisecondsToWait);
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
	
    /**
    * @Given estou logado no sistema com o usuário :arg1 e a senha :arg2
    */
    public function userLogged($username, $password)
    {
        try {
            $this->visit("/login?ReturnToURL=L2FzdHJvbG9naWEvaG9yb3Njb3Bv");
            $this->fillField("txEmail", $username);
            $this->fillField("pwPassword", $password);
            $this->pressButton("psr-user-login");
            if($this->isReadyElementById("psr-user-navbar-logged", 2000))
                return true;
        } catch (Exception $e) {
            throw new Exception("Não foi possível realizar o login do usuário ".$username.".\nInformações detalhadas do erro: ".$e->getMessage());   
        }
    }

    public function checkRadioButton($elementID)
    {
        try {
            $radioButton = $this->getSession()->getPage()->find('css', '#'.$elementID);
            $radioButton->click();
        } catch (Exception $e) {
            throw new Exception("Não foi clicar no elemento de ID ".$elementID."\nInformações detalhadas do erro: ".$e->getMessage());   
        }
    }

    /**
    *@Then o teste está finalizado
    */
    public function resetSession()
    {
        $this->getSession()->reset();
    }
}