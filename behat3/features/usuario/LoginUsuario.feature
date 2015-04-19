#language: pt
Funcionalidade: Login
@javascript
Cenário: Usuário possui cadastro e está na página inicial
	Dado estou em "/login?ReturnToURL=L2FzdHJvbG9naWEvaG9yb3Njb3Bv"
	Quando preencho com "behattestedecadastro@hotmail.com" o campo "txEmail" 
	E preencho com "1234" o campo "pwPassword" 
	Então faço login
	E verifico se estou logado