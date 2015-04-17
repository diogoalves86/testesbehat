#language: pt
Funcionalidade: Usuário jogar Tarot
@javascript
Cenário: Usuário deslogado 
	Dados Eu vou para "/tarot/tarot-do-dia/jogar"
	E devo estar em "/tarot/tarot-do-dia/jogar"
	Quando preencho "tarot-nome-jogador" com "TesteTarotDoDia"
	E sigo o link "daily-tarot-start-game"
	E sigo o link "carta-41"
	Quando jogo o tarot
	Então vejo o jogo de "Jogo de TesteTarotDoDia"


