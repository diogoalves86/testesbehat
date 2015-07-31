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
    E marco o radiobutton "2x de R$ 24,40"
    E digito "AAA" na caixa de texto "Nome gravado no seu cartão"
    E digito "4393540263560197" na caixa de texto "Número do cartão (apenas números)"
    E digito "123" na caixa de texto "Código de segurança"
    E seleciono "01" da caixa de seleção "Mês"
    E seleciono "2019" da caixa de seleção "Ano"
    E marco o checkbox "Sim, já me certifiquei de que todos os dados estão corretos e desejo fechar a compra."
    Então pressiono o botão "FINALIZAR COMPRA"
    E vou para "/seu-perfil/analises/completas?FeedbackPayment=1" 
    E devo ver o texto que coincide com "Sua compra está abaixo."
    Então o teste está finalizado

    