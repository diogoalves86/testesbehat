#language: pt
Funcionalidade: Cadastrar usuário
@javascript
Cenário: Usuário não possui cadastro
	Dados Eu vou para “http://www.personare.com.br/cadastro"	
	E devo estar em "http://www.personare.com.br/cadastro"
	E preencho "Name" com "TesteNome"
	E eu seleciono “01” de "DateDay"
	E eu seleciono “01” de "DateMonth"
	E eu seleciono “1996” de "DateYear"
	E eu seleciono  "2" de “Gender”
	E preencho "txCityName" com “Rio de Janeiro”
	E preencho “E-Mail” com "testecadastro@personare.com.br"
	E preencho “Password” com "123testecadastro" 
	E preencho "Password_Confirm" com "123testecadastro"
	Quando submeto o formulário "FormRegister" 
	Então vou para "cadastro/obrigado?FeedbackRegister=1&ReturnToURL=Lw=="
	E marco “cbReceiveAlerts_1”
	E marco “cbReceiveNews_1” 
	