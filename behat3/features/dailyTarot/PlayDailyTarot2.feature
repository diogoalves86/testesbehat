#language: pt
Funcionalidade: Usuário jogar Tarot
	@javascript
	Cenário: Usuário deslogado 
		Dados estou em "/tarot/tarot-do-dia/jogar"
		Quando digito "TesteTarotDoDia" na caixa de texto "COMO GOSTARIA DE SER CHAMADO?"
		E pressiono o botão "Embaralhar cartas"
		E clico na carta "41"
		Então pressiono o botão "Ler interpretação >>"
		E vou para o jogo de "TesteTarotDoDia"
		E o teste está finalizado