#language: pt 
Funcionalidade: Fazer o mini do MNA 
	@javascript 	 
	Cenário: Usuário logado quer fazer o mini do MNA 
		Dados que estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"  
		E vou para "/numerologia/mapa-do-ano" 
		Quando pressiono o botão "LEIA UMA AMOSTRA GRÁTIS DA ANÁLISE"
		Então seleciono na combobox "SELECIONE O PERFIL" a opção com os dados: 
		| nome        | dia | mes | ano  |
		| AAA         | 25  | 03  | 1996 | 
		E clico no link "SELECIONAR"
		Quando digito "Novo Teste" na caixa de texto "Nome completo, como na certidão de nascimento"

		E clico no link "SELECIONAR"
		Então vou para meu mapa 
		E o teste está finalizado