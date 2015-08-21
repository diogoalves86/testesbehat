#language: pt
Funcionalidade: Realizar o Mini da Revolução Solar
	@javascript
	Cenário: Realizar mini através da página de venda
	Dado que estou no Desktop 
	E que estou logado no sistema com o usuário "aaaaaaaaaaaaaaaaaaaaaa@aaaaaaaaaa.com" e a senha "1234"
	E vou para "/astrologia/revolucao-solar"
	Quando pressiono "LEIA UMA AMOSTRA GRÁTIS DA ANÁLISE"
	E seleciono "AAA - 02/03/1973" da caixa de seleção "Selecione um perfil" 
	E seleciono "02/03/2017 a 02/03/2018" da caixa de seleção "Selecione um período"
	E digito "Rio de Janeiro" na caixa de texto "CIDADE ONDE PASSOU OU PASSARÁ O ANIVERSÁRIO"
	E seleciono "RJ" da caixa de seleção "Selecione o estado"
	Então sigo o link "SELECIONAR"
	E seleciono "Rio de Janeiro - RJ" da caixa de seleção "Selecione uma cidade"
	E sigo o link "CONFIRMAR"
	E o teste está finalizado