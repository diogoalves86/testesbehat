#language: pt
Funcionalidade: Cadastrar usuário
@javascript
Cenário: Usuário não possui cadastro
	Dado Eu estou em "/cadastro"
	Quando preencho com "TesteNome" o campo "Name" 
	E seleciono "2" de “Gender”
	E seleciono “01” de "DateDay"
	E seleciono “01” de "DateMonth"
	E seleciono “1996” de "DateYear"
	E preencho com “Rio de Janeiro” o campo "txCityName" 
	E preencho com "testecadastro@personare.com.br" o campo “E-Mail” 
	E preencho com "123testecadastro" o campo “Password”  
	E preencho com "123testecadastro" o campo "Password_Confirm" 
	Então cadastro o usuário
	E vou para "cadastro/obrigado?FeedbackRegister=1&ReturnToURL=Lw=="
	E marco “cbReceiveAlerts_1”
	E marco “cbReceiveNews_1” 
	