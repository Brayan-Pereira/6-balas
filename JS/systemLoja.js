let carrinhoIcon = document.querySelector('#carrinho');
let carrinho = document.querySelector('.carrinho-espaco');
let fecharCarrinho = document.querySelector('#fechar-carrinho');

let valorCompra = 0;

let contadorProdutosCarrinho = 0;

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
    var codigo = shopProducts.getElementsByClassName('id')[0].innerText;
    var tipo = shopProducts.getElementsByClassName('tipo')[0].innerText;
    // Adiciona os detalhes do produto ao array produtosSelecionados

    addProdutoCarrinho(title, preco, produtoImg, codigo, tipo);
    console.log("preco:" + preco)
    updatetotal();
}

function removeProdutoSelecionado(codigo) {
    var index = produtosSelecionados.findIndex(function (produto) {
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

    contadorProdutosCarrinho++;
    var carrinhoBoxContent = `
        <img src="${produtoImg}" alt="" class="carrinho-imagem">
        <div class="detail-box">
            <div class="titulo-carrinho-produto" id="Title" name="Title">${title}</div>
            <div class="preco-carrinho" id="preco" name="preco">R$${preco}</div>
            <input type="number" id="qtd_${contadorProdutosCarrinho}" name="qtd" value="1" class="quantidade-carrinho">
            <span class="hidden codigo" id="codigo" name="codigo" style="display: none">ID: ${codigo}</span>
            <span class="countProd" id="countProd" name="countProd" style="display: none">${contadorProdutosCarrinho}</span>
        </div>
        <span class="hidden tipo" id="tipo" name="tipo">${tipo}</span>
        <i class='bx bxs-trash-alt remover-carrinho'></i>`;
    carrinhoShopBox.innerHTML = carrinhoBoxContent;
    cartItems.append(carrinhoShopBox);

    carrinhoShopBox.getElementsByClassName("remover-carrinho")[0].addEventListener("click", removeCarrinhoItem);
    carrinhoShopBox.getElementsByClassName("quantidade-carrinho")[0].addEventListener("change", quantityChanged);

    produto = {
        title: title,
        preco: preco,
        codigo: codigo,
        tipo: tipo,
        count: contadorProdutosCarrinho
    };
    produtosSelecionados.push(produto);
}

function atualizaQuantidadeTodos(produtos) {
    // Percorre todos os produtos selecionados
    for (let i = 0; i < produtos.length; i++) {
        // Obtém o ID do input de quantidade para este produto
        let valorCount = produtos[i].count;
        let inputId = `qtd_${valorCount}`;

        // Obtém o valor do input de quantidade
        let inputQuantidade = document.getElementById(inputId);
        let quant = parseInt(inputQuantidade.value, 10);

        // Atualiza a quantidade do produto com o valor do input
        produtos[i].quant = quant;

        console.log(`A quantidade do produto ${produtos[i].title} foi atualizada para ${quant}`);

        
    }
}

function verificarCorrespondenciaValor(valorInput) {
    // Verifique se o valor do input bate com o valor presente no objeto dentro do array
    var objetoProduto = produtosSelecionados.find(function (produto) {
        return produto.count === valorInput;
    });

    if (objetoProduto) {
        console.log("O valor convertido do input bate com o valor presente no objeto:", objetoProduto);

        // Chama a função para atualizar a quantidade de todos os produtos
        atualizaQuantidadeTodos(produtosSelecionados);
    } else {
        console.log("O valor convertido do input não bate com nenhum valor presente no objeto.");
    }
}

function executarAntesDeEnviar() {
        var count = parseInt(document.getElementById("countProd").innerText, 10);

        console.log('Valor do count:', count);

        // Verifique se o valor do input bate com algum valor presente no objeto dentro do array
        verificarCorrespondenciaValor(count);

        console.log(produtosSelecionados, JSON.stringify(produtosSelecionados))

        var inputHidden = document.getElementById("input_hidden")

        var jsonProdutos = JSON.stringify(produtosSelecionados)

        inputHidden.value = jsonProdutos

        
        const opcao = prompt("Digite 'sim' para confirmar")
        if(opcao === "sim"){
            document.getElementById("myForm").submit();
        }
       
}

function inputQuant() {
    return inputQtd.value;
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