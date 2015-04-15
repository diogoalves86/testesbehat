#language: pt
Funcionalidade: Login
@javascript
Cenário: Usuário possui cadastro e está na página inicial
	Dado Eu Estou em "/login?ReturnToURL=L2FzdHJvbG9naWEvaG9yb3Njb3Bv"
	E Eu preencho "txEmail" com "behattestedecadastro@hotmail.com"
	E Eu preencho “txSenha” com "1234"
	E Faco Login