#language: pt
Funcionalidade: Cadastrar usuário
	@javascript
	Cenário: Usuário não possui cadastro
		Dado estou em "/cadastro"
		Quando preencho o formulário de cadastro com os seguintes dados:
			| nome       | sexoValor  | dia | mês | ano  | hora  | minuto |  cidade        |          email                                           | senha   | confirmacaoSenha   |
		    | Novo Teste | 1          | 25  | 03  | 1996 | 12    |   30   | Rio de Janeiro | testebehatfinalizandocadastmarjorie2345@hotmail.com           |  1234   | 1234               |
		Então envio o formulário de cadastro
		E aguardo "20" segundos
		E devo estar em "/cadastro/obrigado?FeedbackRegister=1&ReturnToURL=Lw=="
		E marco para receber dicas e horóscopo via e-mail
		E finalizo meu cadastro