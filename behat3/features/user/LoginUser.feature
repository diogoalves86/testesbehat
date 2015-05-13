#language: pt
Funcionalidade: Login
@javascript
Cenário: Usuário possui cadastro e está na página inicial
	Dado estou em "/login?ReturnToURL=L2FzdHJvbG9naWEvaG9yb3Njb3Bv"
	Quando faço login com os seguintes dados: 
		|     email                                              |  senha       |
		|     aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com              |   1234       |
	Então verifico se estou logado