#language: pt
Funcionalidade: Comprar produto completo
@javascript
Cenário: Usuário logado quer comprar completo
	Dados estou logado no sistema com o usuário "behattestedecadastro@hotmail.com" e a senha "1234"
	E vou para "/carrinho"
	Quando adiciono o produto de código "86" ao carrinho
	E compro este produto com os seguintes dados:
		| codigoTipoPagamento | codigoNumeroParcelas |   nome           |  numeroCartao    | codigoCartao | mesValidadeCartao | anoValidadeCartao | 
		|       1             |       1              |  testecompletota | 4393540263560197 |     123      |       01          |      2025         |
	E aguardo "15" segundos
	Então devo estar em "/seu-perfil/analises/completas?FeedbackPayment=1" 