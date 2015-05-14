#language: pt
Funcionalidade: Adicionar novo perfil a partir do mini do MNA
        	@javascript
        	Cenário: Usuário logado quer adicionar novo perfil a partir do mini do MNA
                    	Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
                    	E vou para "/numerologia/mapa-do-ano"
                    	Quando clico em "ler uma amostra grátis da análise"
		E aguardo “4” segundos
                    	Então abre a pop “selecione a pessoa a ser analisada” 
                    	E seleciono a opção:
“Adicionar novo perfil”
                    	E aguardo "4" segundos
             	Então abre a pop “Edição de perfil”
                    	E preencho com os seguintes dados:
| nome       | sexoValor  | dia | mês | ano  | hora  | minuto |  cidade                                 	                        	| Novo Teste | 1      	| 25  | 03  | 1996 | 12	|   30   | Rio de Janeiro   |  
E clico em “salvar”  
