#language: pt 
Funcionalidade: Fazer o mini do MNA 
	@javascript 	 
	Cenário: Usuário logado quer fazer o mini do MNA 
		Dados estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"  
		E vou para "/numerologia/mapa-do-ano" 
		Quando clico em "ler uma amostra grátis da análise" 
		Então seleciono o perfil com os seguintes dados: 
		| nome        | dia | mes | ano  |
		| aaaa        | 25  | 03  | 1996 | 
		E clico em "Selecionar"
		Quando preencho a pessoa ser analisada com os seguintes dados:
		| nome       | dia | mês | ano       | anoAnalisado   
		| Novo Teste | 25  | 03  | 1996      | 2015  
		E clico em "Selecionar" 
		Então vou para meu mapa 
		E o teste está finalizado