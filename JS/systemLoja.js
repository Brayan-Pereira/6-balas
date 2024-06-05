let carrinhoIcon = document.querySelector('#carrinho');
let carrinho = document.querySelector('.carrinho-espaco');
let fecharCarrinho = document.querySelector('#fechar-carrinho');

let valorCompra = 0;
let contadorProdutosCarrinho = 0;
let produtosSelecionados = [];


let usuario = JSON.parse(localStorage.getItem('usuario'));


carrinhoIcon.onclick = () => {
    carrinho.classList.add("active");
};
fecharCarrinho.onclick = () => {
    carrinho.classList.remove("active");
};

if (document.readyState === 'loading') {
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
        if (usuario) {
            console.log("Usuario: " + usuario.nome);
            console.log("IDUsuario: " + usuario.idUser);
            executarAntesDeEnviar();
        } else {
            console.log("Usuario não logado")

            const novaURL = "http://localhost/6-balas/Pages/user/login.php";
            window.location.href = novaURL;
        }

    }
}

function removeCarrinhoItem(event) {
    var buttonClicked = event.target;
    var carrinhoItem = buttonClicked.closest('.carrinho-box');
    var codigoProduto = carrinhoItem.querySelector('.codigo').innerText.replace('ID: ', '');
    removeProdutoSelecionado(codigoProduto);
    carrinhoItem.remove();
    updatetotal();
}

function addCarrinhoClicked(event) {
    var button = event.target;
    var shopProducts = button.parentElement;
    var title = shopProducts.getElementsByClassName('titulo-produto')[0].innerText;
    var preco = shopProducts.getElementsByClassName('preco')[0].innerText.replace('R$', '');
    var produtoImg = shopProducts.getElementsByClassName('produto-img')[0].src;
    var codigo = shopProducts.getElementsByClassName('id')[0].innerText;
    var tipo = shopProducts.getElementsByClassName('tipo')[0].innerText;

    addProdutoCarrinho(title, preco, produtoImg, codigo, tipo);
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
            <div class="titulo-carrinho-produto">${title}</div>
            <div class="preco-carrinho">R$${preco}</div>
            <input type="number" value="1" class="quantidade-carrinho" id="qtd_${contadorProdutosCarrinho}">
            <span class="hidden codigo" style="display: none">ID: ${codigo}</span>
            <span class="countProd" style="display: none">${contadorProdutosCarrinho}</span>
        </div>
        <span class="hidden tipo" style="display: none">${tipo}</span>
        <i class='bx bxs-trash-alt remover-carrinho'></i>`;
    carrinhoShopBox.innerHTML = carrinhoBoxContent;
    cartItems.append(carrinhoShopBox);

    carrinhoShopBox.getElementsByClassName("remover-carrinho")[0].addEventListener("click", removeCarrinhoItem);
    carrinhoShopBox.getElementsByClassName("quantidade-carrinho")[0].addEventListener("change", quantityChanged);

    produtosSelecionados.push({
        title: title,
        preco: preco,
        codigo: codigo,
        tipo: tipo,
        count: contadorProdutosCarrinho,
        quant: 1
    });
}

function atualizaQuantidadeTodos() {
    for (let i = 0; i < produtosSelecionados.length; i++) {
        let valorCount = produtosSelecionados[i].count;
        let inputId = `qtd_${valorCount}`;
        let inputQuantidade = document.getElementById(inputId);
        let quant = parseInt(inputQuantidade.value, 10);
        produtosSelecionados[i].quant = quant;
    }
}

function verificarCorrespondenciaValor(valorInput) {
    var objetoProduto = produtosSelecionados.find(function (produto) {
        return produto.count === valorInput;
    });
    if (objetoProduto) {
        atualizaQuantidadeTodos();
    }
}

function executarAntesDeEnviar() {
    var count = parseInt(document.querySelector(".countProd").innerText, 10);
    verificarCorrespondenciaValor(count);
    var inputHidden = document.getElementById("input_hidden");
    var jsonProdutos = JSON.stringify(produtosSelecionados);
    inputHidden.value = jsonProdutos;

    document.getElementById("myForm").submit();

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
        var priceText = priceElement.innerText.replace("R$", "").replace(",", "."); // Substitui vírgula por ponto
        var price = parseFloat(priceText);
        var quantity = parseInt(quantityElement.value);
        total += price * quantity;
    }
    total = Math.round(total * 100) / 100;
    valorCompra = total;
    localStorage.setItem('precoTotal', JSON.stringify(valorCompra));
    document.getElementsByClassName('preco-total')[0].innerText = 'R$' + total;
}