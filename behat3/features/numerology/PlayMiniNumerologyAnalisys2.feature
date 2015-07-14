#language: pt 
Funcionalidade: Fazer o mini do MNA 
	@javascript 	 
	Cenário: Usuário logado quer fazer o mini do MNA 
		Dados que estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"  
		E vou para "/numerologia/mapa-do-ano" 
		Quando pressiono o botão "LEIA UMA AMOSTRA GRÁTIS DA ANÁLISE"
		Então seleciono o perfil com os seguintes dados: 
		| nome        | dia | mes | ano  |
		| AAA         | 25  | 03  | 1996 | 
		E clico em "Selecionar" no "MNA"
		Quando preencho a pessoa ser analisada com os seguintes dados:
		| nome       | dia | mes | ano       | anoAnalisado | 
		| Novo Teste | 25  | 03  | 1996      | 2015         |
		E clico em "Selecionar" no "MNA"
		Então vou para meu mapa 
		E o teste está finalizado