#language: pt
Funcionalidade: Comprar produto completo
@javascript
Cenário: Usuário logado quer comprar completo
	Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
	E vou para "/carrinho"
	Quando avanço para o passo "2" da compra
	E escolho a forma de pagamento de identificação "2"
	E seleciono "À VISTA R$ 129,40" de "rbPaymentTimes"
	E eu digito “testecompletota”
	E eu digito “4393540263560197”
	E eu digito “123”
	E eu seleciono “data de validade”
	E eu confirmo o meu e-mail
	Quando eu clico em "finalizar compra"
	E vou para “/seu-perfil/analises/completas?FeedbackPayment=1”
	Então devo visualizar o meu jogo: 
	"""
	“Tarot e o amor”
	"""
