#language: pt
Funcionalidade: Login
@javascript
Cenário: Usuário possui cadastro e está na página inicial

	Dado estou em "/login?ReturnToURL=L2FzdHJvbG9naWEvaG9yb3Njb3Bv"
	Quando digito "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" na caixa de texto "E-mail"
	E digito "1234" na caixa de texto "Senha"
	Então pressiono "Continuar »"
	E verifico se estou logado
	E o teste está finalizado