#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dados que estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando clico em "ler uma amostra grátis da análise"
		Então o campo "tarot-nome-jogador" deve conter "AAA"
		Quando clico no link "Iniciar"
		Então marco o radiobutton "psr-ta-choice-option-1"
		E clico no link "psr-ta-load-phrases"
		Quando clico em "Embaralhar"
		E sorteio as cartas
		E clico em "Leia o resultado"
		Então vou para meu jogo
		E o teste está finalizado