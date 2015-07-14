#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dado que estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando pressiono o botão "LEIA UMA AMOSTRA GRÁTIS DA ANÁLISE"
		Então a caixa de texto "Como gostaria de ser chamado?" deve conter "AAA"
		Quando pressiono o botão "Iniciar >>"
		Então marco o radiobutton "Revele meu futuro afetivo"
		E pressiono o botão "Continuar >>"
		Quando pressiono o botão "Embaralhar >>"
		E clico na carta "12"
		E clico na carta "20"
		E clico na carta "33"
		E clico na carta "5"
		E clico na carta "2"
		E clico na carta "19"
		E pressiono o botão "Leia o Resultado >>"
		Então vou para meu jogo
		E o teste está finalizado