#language: pt
Funcionalidade: Usuário jogar Tarot
	@javascript
	Cenário: Usuário deslogado 
		Dados estou em "/tarot/tarot-do-dia/jogar"
		Quando preencho o nome do jogador com "TesteTarotDoDia"
		E embaralho as cartas do jogo
		E sigo o link "carta-41"
		Então jogo o tarot
		E vou para o jogo de "TesteTarotDoDia"


