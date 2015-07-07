#language: pt
Funcionalidade: Login
@javascript
Cenário: Usuário possui cadastro e está na página inicial

	Dado estou em "/login"
	Quando digito "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" na caixa de texto "E-mail"
	E digito "1234" na caixa de texto "Senha"
	Então pressiono "Continuar »"
	E visualizo minha barra de usuario
	E o teste está finalizado