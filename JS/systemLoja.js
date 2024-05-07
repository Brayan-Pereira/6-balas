let carrinhoIcon = document.querySelector('#carrinho');
let carrinho = document.querySelector('.carrinho-espaco');
let fecharCarrinho = document.querySelector('#fechar-carrinho');

let valorCompra = 0;

// Inicialize produtosSelecionados como um array vazio
let produtosSelecionados = [];

carrinhoIcon.onclick = () => {
    carrinho.classList.add("active");
};
fecharCarrinho.onclick = () => {
    carrinho.classList.remove("active");
};

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready();
}

function ready() {
    var removeCarrinhoButtons = document.getElementsByClassName('remover-carrinho');
    for (var i = 0; i < removeCarrinhoButtons.length; i++) {
        var button = removeCarrinhoButtons[i];
        button.addEventListener('click', removeCarrinhoItem);
    }
    var quantityInputs = document.getElementsByClassName('quantidade-carrinho');
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i];
        input.addEventListener("change", quantityChanged);
    }

    var addCarrinho = document.getElementsByClassName('add-carrinho');
    for (var i = 0; i < addCarrinho.length; i++) {
        var button = addCarrinho[i];
        button.addEventListener("click", addCarrinhoClicked);
    }

    document.getElementsByClassName('btn-comprar')[0].addEventListener('click', buyButtonClicked);
}
function buyButtonClicked() {
    if (valorCompra === 0) {
        alert('Selecione algum produto!');
    } else {
        // Converter produtosSelecionados para JSON
        var produtosSelecionadosJSON = JSON.stringify(produtosSelecionados);
        
        // Enviar os dados do produto para o PHP
        fetch('http://localhost/6-BALAS/DB_php/INSERT/processar_venda.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: produtosSelecionadosJSON // Passar a variável produtosSelecionadosJSON como corpo da requisição
        })
        .then(response => {
            if (response.ok) {

                console.log(produtosSelecionados, produtosSelecionadosJSON)
                // Limpar o conteúdo do carrinho
                var carrinhoContent = document.getElementsByClassName('conteudo-carrinho')[0];
                while (carrinhoContent.hasChildNodes()) {
                    carrinhoContent.removeChild(carrinhoContent.firstChild);
                }
                // Limpar o array de produtos selecionados
                produtosSelecionados = [];
                // Atualizar o total
                updatetotal();
                alert('Seu pedido foi feito.');
            } else {
                alert('Ocorreu um erro ao processar o pedido.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Ocorreu um erro ao processar o pedido.');
        });
    }
}



function removeCarrinhoItem(event) {
    var buttonClicked = event.target;
    var carrinhoItem = buttonClicked.closest('.carrinho-box');
    var codigoProduto = carrinhoItem.querySelector('.codigo').innerText;
    removeProdutoSelecionado(codigoProduto);
    carrinhoItem.remove();
    updatetotal();
}

function addCarrinhoClicked(event) {
    var button = event.target;
    var shopProducts = button.parentElement;
    var title = shopProducts.getElementsByClassName('titulo-produto')[0].innerText;
    var preco = shopProducts.getElementsByClassName('preco')[0].innerText;
    var produtoImg = shopProducts.getElementsByClassName('produto-img')[0].src;
    var cod = shopProducts.getElementsByClassName('id')[0].innerText;
    var tipo = shopProducts.getElementsByClassName('tipo')[0].innerText;
    // Adiciona os detalhes do produto ao array produtosSelecionados
    produtosSelecionados.push({ title: title, preco: preco, codigo: cod, tipo: tipo });
    addProdutoCarrinho(title, preco, produtoImg, cod, tipo);
    updatetotal();
}

function removeProdutoSelecionado(codigo) {
    var index = produtosSelecionados.findIndex(function(produto) {
        return produto.codigo === codigo;
    });

    if (index !== -1) {
        produtosSelecionados.splice(index, 1);
    }
}

function addProdutoCarrinho(title, preco, produtoImg, codigo, tipo) {
    var carrinhoShopBox = document.createElement("div");
    carrinhoShopBox.classList.add("carrinho-box");
    var cartItems = document.getElementsByClassName("conteudo-carrinho")[0];
    var cartItemsNames = cartItems.getElementsByClassName("titulo-carrinho-produto");
    for (var i = 0; i < cartItemsNames.length; i++) {
        if (cartItemsNames[i].innerText == title) {
            alert("Você já adicionou este item ao carrinho");
            return;
        }
    }
    var carrinhoBoxContent = `
        <img src="${produtoImg}" alt="" class="carrinho-imagem">
        <div class="detail-box">
            <div class="titulo-carrinho-produto" id="Title" name="Title">${title}</div>
            <div class="preco-carrinho" id="preco" name="preco">${preco}</div>
            <input type="number" value="1" class="quantidade-carrinho">
            <span class="hidden codigo" id="codigo" name="codigo" >${codigo}</span>
        </div>
       
        <span class="hidden tipo" id="tipo" name="tipo">${tipo}</span>
        <i class='bx bxs-trash-alt remover-carrinho'></i>`;
    carrinhoShopBox.innerHTML = carrinhoBoxContent;
    cartItems.append(carrinhoShopBox);
    carrinhoShopBox.getElementsByClassName("remover-carrinho")[0].addEventListener("click", removeCarrinhoItem);
    carrinhoShopBox.getElementsByClassName("quantidade-carrinho")[0].addEventListener("change", quantityChanged);

}

function quantityChanged(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updatetotal();
}

function updatetotal() {
    var carrinhoContent = document.getElementsByClassName('conteudo-carrinho')[0];
    var carrinhoBoxes = carrinhoContent.getElementsByClassName('carrinho-box');
    var total = 0;
    for (var i = 0; i < carrinhoBoxes.length; i++) {
        var carrinhoBox = carrinhoBoxes[i];
        var priceElement = carrinhoBox.getElementsByClassName('preco-carrinho')[0];
        var quantityElement = carrinhoBox.getElementsByClassName('quantidade-carrinho')[0];
        var price = parseFloat(priceElement.innerText.replace("R$", ""));
        var quantity = quantityElement.value;
        total = total + (price * quantity);
    }
    total = Math.round(total * 100) / 100;
    valorCompra = total;

    document.getElementsByClassName('preco-total')[0].innerText = 'R$' + total;
}