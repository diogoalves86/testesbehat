#language: pt
Funcionalidade: Usuário jogar Tarot
@javascript
Cenário: Usuário deslogado 
	Dados Eu vou para "/tarot/tarot-do-dia/jogar"
	E devo estar em "/tarot/tarot-do-dia/jogar"
	Quando preencho "tarot-nome-jogador" com "TesteTarotDoDia"
	E embaralho as cartas do jogo
	E sigo o link "carta-41"
	Quando jogo o tarot
	Então vou para o jogo de "TesteTarotDoDia"


