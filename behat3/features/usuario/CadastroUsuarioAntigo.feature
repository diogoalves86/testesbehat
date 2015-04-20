#language: pt
Funcionalidade: Cadastrar usuário
	@javascript
	Cenário: Usuário não possui cadastro
		Dado estou em "/cadastro"
		Quando preencho com "TesteNome" o campo "Name"
		E preencho com “Rio de Janeiro” o campo "txCityName" 
		E preencho com "testecadastro@personare.com.br" o campo “E-Mail” 
		E preencho com "123testecadastro" o campo “Password”  
		E preencho com "123testecadastro" o campo "Password_Confirm" 
		E seleciono "2" de “ddGender”
		E seleciono “25” de "ddBirthDateDay"
		E seleciono “03” de "ddBirthDateMonth"
		E seleciono “1996” de "ddBirthDateYear"
		Então cadastro o usuário
		E vou para "cadastro/obrigado?FeedbackRegister=1&ReturnToURL=Lw=="
		E marco “cbReceiveAlerts_1”
		E marco “cbReceiveNews_1” 
		