#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dado que estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando pressiono "LEIA UMA AMOSTRA GRÁTIS DA ANÁLISE"
		Então a caixa de texto "Como gostaria de ser chamado?" deve conter "AAA"
		Quando pressiono "Iniciar >>"
		Então aguardo e marco o radiobutton "Revele meu futuro afetivo"
		E aguardo e pressiono "Continuar >>"
		Quando aguardo e pressiono "Embaralhar >>"
		E clico na carta "12"
		E clico na carta "20"
		E clico na carta "33"
		E clico na carta "5"
		E clico na carta "2"
		E clico na carta "19"
		Então aguardo e pressiono "Leia o Resultado >>"
		E vou para meu jogo
		E o teste está finalizado