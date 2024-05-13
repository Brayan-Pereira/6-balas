<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Cervejaria 6 balas</title>
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/loja_Online/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<script src="http://localhost/6-BALAS/JS/systemLoja.js" defer></script>
    <header>
        <div class="nav container">
            <a href="#" class="logo">Carrinho</a>
            <i class='bx bx-cart' id="carrinho"></i>
            <div class="carrinho-espaco">

                <h2 class="titulo-carrinho">Seu Carrinho</h2>
                <div class="conteudo-carrinho"></div>
                <div class="total">
                    <div class="titulo-total">Total</div>
                    <div class="preco-total">R$0</div>
                </div>

                <form id="myForm" action="http://localhost/6-BALAS/DB_php/INSERT/processar_venda.php" method="post">
                    <input type="text" name="input_hidden" id="input_hidden" style="display: none" required>
                    <button type="button" class="btn-comprar" onclick="executarAntesDeEnviar()">Comprar Agora</button>
                </form>
                <i class='bx bx-x' id="fechar-carrinho"></i>

            </div>
        </div>
    </header>
    <section class="shop container">
        <h2 class="section-title">Loja de Produtos</h2>
        <div class="conteudo-loja">
            <?php
            include './config.php';

            // Função para gerar número aleatório e selecionar imagem
            function gerarNumeroAleatorioEArray()
            {
                // Gerar um número aleatório de 0 a 2
                $numeroAleatorio = rand(0, 2);

                // Sintaxe de um array com 3 elementos
                $array = array(
                    "http://localhost/6-balas/Components/loja_Online/1.png",
                    "http://localhost/6-balas/Components/loja_Online/2.png",
                    "http://localhost/6-balas/Components/loja_Online/3.png"
                );

                // Retorna o número aleatório e o array
                return $array[$numeroAleatorio];
            }

            // Consulta SQL para obter os produtos
            $sql = "SELECT * FROM produtos";
            $result = $conn->query($sql);

            // Exibir os produtos
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-box'>";
                    // Chamando a função para selecionar a imagem aleatória
                    $imagem = gerarNumeroAleatorioEArray();
                    echo "<img src='$imagem' alt='' class='produto-img'>";
                    echo "<h2 class='titulo-produto'>" . $row['nomecerveja'] . "</h2>";
                    // Adicionando o ID e o tipo do produto como spans
                    echo "<span class='id'>" . $row['id'] . "</span>";
                    echo "<span class='tipo'>Tipo: " . $row['tipo'] . "</span>";
                    echo "<span class='preco'>" . number_format($row['valor'], 2, ',', '.') . "</span>";
                    echo "<i class='bx bxs-shopping-bag add-carrinho'></i>";
                    echo "</div>";
                }
            } else {
                echo "Nenhum produto encontrado.";
            }
            $conn->close();
            ?>
        </div>
    </section>
   
</body>

</html>