#language: pt
Funcionalidade: Cadastrar usuário
@javascript
Cenário: Usuário não possui cadastro
	Dados Eu estou na página de entrada
	Quando vou para “/cadastro"	
	E preencho com "TesteNome" o campo "Name" 
	E eu seleciono “01” de "DateDay"
	E eu seleciono “01” de "DateMonth"
	E eu seleciono “1996” de "DateYear"
	E eu seleciono  "2" de “Gender”
	E preencho com “Rio de Janeiro” o campo "txCityName" 
	E preencho com "testecadastro@personare.com.br" o campo “E-Mail” 
	E preencho com "123testecadastro" o campo “Password”  
	E preencho com "123testecadastro" o campo "Password_Confirm" 
	Quando cadastro o usuário
	Então vou para "cadastro/obrigado?FeedbackRegister=1&ReturnToURL=Lw=="
	E marco “cbReceiveAlerts_1”
	E marco “cbReceiveNews_1” 
	