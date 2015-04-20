#language: pt
Funcionalidade: Comprar produto completo
@javascript
Cenário: Usuário logado quer comprar completo
	Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
	E vou para "/carrinho"
	E clico em "PROSSEGUIR COM A COMPRA"
	Quando escolho a forma de pagamento de identificação "2"
	E aguardo "5" segundos
	E seleciono "1" de "rbPaymentTimes"
	E preencho com “testecompletota” o campo "nome_cartao"
	E preencho com “4393540263560197” o campo "numero_cartao" 
	E preencho com “123” o campo "codico_seguranca"
	E seleciono "01" de “ddValidityMonth”
	E seleciono "2025" de "ddValidityYear"
	E marco "cbDataIsOK"
	Então clico em "FINALIZAR COMPRA"
	E aguardo "5" segundos
	Então devo estar em “/seu-perfil/analises/completas?FeedbackPayment=1”
	E devo ver “Tarot e o amor”
