#language: pt 
Funcionalidade: Fazer o mini do MNA 
	@javascript 	 
	Cenário: Usuário logado quer fazer o mini do MNA 
		Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"  
		E vou para "/numerologia/mapa-­do-­ano" 
		Quando clico em "ler uma amostra grátis da análise" 
		E aguardo “4” segundos 
		Então abre a pop “selecione a pessoa a ser analisada”  
		E seleciono o perfil: 
		Novo Teste  | 25  | 03  | 1996 | 
		E aguardo "4" segundos 
		Então abre a pop “selecione a pessoa a ser analisada” 
		E preencho com os dados: 
		| nome  | dia | mês | ano  | ano a ser analisado   
		| Novo Teste | 25  | 03  | 1996 | 1  
		E clico em "selecionar" 
		E aguardo "10" segundos 
		Então vou para meu mapa 