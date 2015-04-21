#language: pt
Funcionalidade: Cadastrar usuário
	@javascript
	Cenário: Usuário não possui cadastro
		Dado estou em "/cadastro"
		Quando preencho o formulário de cadastro com os seguintes dados:
			| nome       | sexoValor  | dia | mês | ano  | hora  | minuto |  cidade        |   email                          | senha  | confirmacaoSenha  |
		    | Novo Teste | 1          | 25  | 03  | 1996 | 12    |   30   | Rio de Janeiro | aaastedecadastro@hotmail.com     |  123   | 123               |
		Então envio o formulário de cadastro
		E aguardo "10" segundos