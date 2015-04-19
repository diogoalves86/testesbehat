#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando clico em "ler uma amostra grátis"
		Então o campo "tarot-nome-jogador" deve conter "testetarotamor"
		Quando sigo o link "ta-avancar-pt1"
		E aguardo "6" segundos
		E seleciono revelar meu futuro afetivo
		E clico em "Continuar"
		E aguardo "22" segundos
		E embaralho as cartas
		E sorteio as cartas
		E clico em "Leia o resultado"
		Então devo ver "Jogo de: testetarotamor”