#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando vou para "/tarot/tarot-e-o-amor/mini/jogar"
		E sigo o link “ta-avancar-pt1” 
		E checar a opção de texto “ Revele meu futuro afetivo”
		E eu clico em "continuar"
		E eu clico em “embaralhar”
		E eu sorteio as cartas
		Quando eu clico em "leia o resultado"
		E vou para o "resultado"
		Então devo visualizar meu nome: 
		"""
		Jogo de: “testetaroteoamor”
		"""