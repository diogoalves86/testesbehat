#language: pt
Funcionalidade: Fazer o mini do MA
    @javascript
    Cenário: Usuário logado quer fazer o mini do MA
        Dados que estou no Desktop 
        E que estou logado no sistema com o usuário "rtancman@gmail.com" e a senha "1234"
    	E vou para "/astrologia/mapa-astral"
    	Quando pressiono "LEIA UMA AMOSTRA GRÁTIS DA ANÁLISE"
    	Então seleciono "AAA - 02/03/1973" da caixa de seleção "Selecione"
     	E sigo o link "SELECIONAR"
     	Então vou para meu mapa
        E o teste está finalizado