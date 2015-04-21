#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando clico em "ler uma amostra grátis"
		Então o nome preenchido no formulário deverá ser "testetarotamor"
		Quando clico em "Iniciar"
		E aguardo "6" segundos
		Então seleciono revelar meu futuro afetivo
		E clico em "Continuar"
		E aguardo "22" segundos
		Quando embaralho as cartas
		E sorteio as cartas
		E clico em "Leia o resultado"
		E aguardo "16" segundos
		Então vou para meu jogo