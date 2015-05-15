#language: pt
Funcionalidade: Adicionar novo perfil a partir do mini do MNA
	@javascript
	Cenário: Usuário logado quer adicionar novo perfil a partir do mini do MNA
    	Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
    	E vou para "/numerologia/mapa-do-ano"
    	Quando clico em "ler uma amostra grátis da análise"
    	E seleciono a opção “Adicionar novo perfil”
    	Quando adiciono um novo perfil com os seguintes dados:
            | nome       | sexoValor  | dia | mes | ano  | possuiHoraNascimento      |  hora  | minuto |  cidade          |
            | Novo Teste | 1      	  | 25  | 03  | 1996 |       sim                 |  12	  |   30   | Rio de Janeiro   |  
        Então clico em “Salvar”
        E clico em "Selecionar"
        E o teste está finalizado
