#language: pt
Funcionalidade: Comprar produto completo
@javascript
Cenário: Usuario realiza compra do mapa astral atraves da pagina de venda
	Dados que estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"
	E vou para "/astrologia/mapa-astral"
	Quando sigo o link "COMPRAR Adicione ao carrinho"
             Então verifico se o produto "MAPA ASTRAL" foi adicionado
             E pressiono o botão "PROSSEGUIR COM A COMPRA >>"
             Quando sigo o link "Visa"