#language: pt
Funcionalidade: Usuário jogar Tarot
@javascript
Cenário: Usuário deslogado 
	Dados Eu vou para "/tarot/tarot-do-dia/jogar"
	E devo estar em "/tarot/tarot-do-dia/jogar"
	E preencho "tarot-nome-jogador" com "TesteTarotDoDia"
	E sigo o link "daily-tarot-start-game"
	E sigo o link "carta-41"
	Então sigo o link "daily-tarot-close-game"
	Então devo ver "TesteTarotDoDia"


