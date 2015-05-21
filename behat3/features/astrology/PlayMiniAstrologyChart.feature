#language: pt
Funcionalidade: Fazer o mini do MA
    @javascript
    Cenário: Usuário logado quer fazer o mini do MA
        Dados estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"
    	E vou para "/astrologia/mapa-astral"
    	Quando clico em "ler uma amostra grátis da análise"
    	Então seleciono o perfil com os seguintes dados: 
        | nome        | dia | mes | ano  |
        | aaaa        | 25  | 03  | 1996 | 
     	E clico em "Selecionar"
     	Então vou para meu mapa
        E o teste está finalizado