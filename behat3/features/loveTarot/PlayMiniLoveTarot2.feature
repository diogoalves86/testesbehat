#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dado que estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando pressiono "LEIA UMA AMOSTRA GRÁTIS DA ANÁLISE"
		Então a caixa de texto "Como gostaria de ser chamado?" deve conter "AAA"
		Quando pressiono "Iniciar >>"
		E aguardo "4" segundos
		Então marco o radiobutton "Revele meu futuro afetivo"
		E pressiono "Continuar >>"
		Quando pressiono "Embaralhar >>"
		E sorteio as cartas
		E pressiono "Leia o Resultado >>"
		Então vou para meu jogo
		E o teste está finalizado