#language: pt
Funcionalidade: Login
@javascript
Cenário: Usuário possui cadastro e está na página inicial
	Dado Eu estou na página de entrada
	Quando vou para "/login?ReturnToURL=L2FzdHJvbG9naWEvaG9yb3Njb3Bv"
	E preencho com "behattestedecadastro@hotmail.com" o campo "txEmail" 
	E preencho com "1234" o campo "pwPassword" 
	Quando faço login
	Então verifico se estou logado