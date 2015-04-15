#language: pt
Funcionalidade: Comprar produto completo
Cenário: Usuário logado quer comprar completo
	Dados Estou em "/carrinho"
	E eu sigo o link “bt_comprar”
	E eu seleciono a forma de pagamento
	E eu seleciono bandeira
	E eu seleciono número de parcelas
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
