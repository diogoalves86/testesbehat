#language: pt
Funcionalidade: Fazer o mini do TA
	@javascript
	Cenário: Usuário logado quer fazer o mini do TA
		Dados estou logado no sistema com o usuário "rtancman@gmail.com" e a senha "1234"
		E vou para "/tarot/tarot-e-o-amor"
		Quando clico em "ler uma amostra grátis da análise"
		Então o nome preenchido no formulário deverá ser "Raffael"
		Quando clico em "Iniciar"
		Então seleciono revelar meu futuro afetivo
		E clico em "Continuar"
		Quando clico em "Embaralhar"
		E sorteio as cartas
		E clico em "Leia o resultado"
		Então vou para meu jogo
		E o teste está finalizado