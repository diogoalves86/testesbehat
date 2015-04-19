#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando vou para "/tarot/tarot-e-o-amor/mini/jogar"
		Então o campo "tarot-nome-jogador" deve conter "testetarotamor"
		Quando sigo o link "ta-avancar-pt1"
		E aguardo "6" segundos
		E seleciono revelar meu futuro afetivo
		E embaralho as cartas
		E sorteio as cartas
		Quando sigo o link "ta-close-game"
		E aguardo "6" segundos
		Então devo ver "Jogo de: testetarotamor”