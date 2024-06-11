<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Relatório de Vendas</title>
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/global.css">
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/header.css">
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/main.css">

    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        body {
            background-color: #000000; /* Fundo preto */
            color: #FFFFFF; /* Cor das letras */
            font-family: Arial, sans-serif;
            padding: 20px; /* Adicionando um pouco de espaço ao redor do conteúdo */
            margin: 0; /* Remover margem padrão do corpo */
            padding: 0; /* Remover preenchimento padrão do corpo */
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.8); /* Fundo escuro */
            padding: 10px 20px; /* Espaçamento interno do cabeçalho */
        }

        main {
            padding-top: 100px; /* Adicionando espaço para o cabeçalho */
            display: flex;
            flex-direction: column; /* Organizando os elementos em coluna */
            justify-content: center; /* Centralizando o conteúdo verticalmente */
            align-items: center; /* Centralizando o conteúdo horizontalmente */
            height: 100vh; /* Definindo altura total da viewport */
        }

        h1 {
            margin-bottom: 40px; /* Espaço abaixo do título "Relatório de Vendas" */
        }

        .table {
            color: #ffffff;
            opacity: .8;
        }
    </style>
</head>
<body>
<script src="http://localhost/6-balas/JS/menu.js" defer></script>
    <header>
        <nav>
            <span class="material-symbols-outlined" id="btn_menu">
                menu
            </span>
    
            <section class="menu_hamburger" id="menu_hamburger">
                <div class="topo_menu">
                    <img src="http://localhost/6-BALAS/Components/gun.png" alt="">
                    <span class="material-symbols-outlined" id="btnOff_menu">
                        close
                    </span>
                </div>
    
                <ul>
                    <li><a href="////localhost/6-balas/index.html">Tela inicial</a></li>
                    <li><a onclick="verificacao()" href="////localhost/6-balas/Pages/admin/admin.html">Área do administrador</a></li>
                </ul>
            </section>
        </nav>
    
        <div class="logo">
            <img src="http://localhost/6-BALAS/Components/header/logo/logo.png" alt="">
        </div>
    </header>
    <main>
    <div class="container">
        <h1 class="mt-5">Relatório de Vendas</h1>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Código de Venda</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Produtos</th>
                    <th scope="col">Quantidade Total</th>
                    <th scope="col">Valor Total</th>
                    <th scope="col">Data da Venda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../config.php';

                $sql = "SELECT v.codigo_venda, CONCAT(c.firstname, ' ', c.lastname) AS nome_cliente,
                               p.nomecerveja, v.quantidade, v.valor_unitario, 
                               (v.quantidade * v.valor_unitario) AS valor_total, v.data_venda
                        FROM vendas v
                        JOIN produtos p ON v.id_produto = p.id
                        JOIN clientes c ON v.id_cliente = c.id
                        ORDER BY v.codigo_venda, v.id_produto";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $current_codigo_venda = null;
                    $produtos = [];
                    $quantidade_total = 0;
                    $valor_total = 0;

                    while ($row = $result->fetch_assoc()) {
                        if ($current_codigo_venda != $row['codigo_venda']) {
                            if ($current_codigo_venda !== null) {
                                echo "<tr>";
                                echo "<th scope='row'>{$current_codigo_venda}</th>";
                                echo "<td>{$nome_cliente}</td>";
                                echo "<td><ul>";
                                foreach ($produtos as $produto) {
                                    echo "<li>{$produto}</li>";
                                }
                                echo "</ul></td>";
                                echo "<td>{$quantidade_total}</td>";
                                echo "<td>R$ " . number_format($valor_total, 2, ',', '.') . "</td>";
                                echo "<td>{$data_venda}</td>";
                                echo "</tr>";

                                $produtos = [];
                                $quantidade_total = 0;
                                $valor_total = 0;
                            }
                            $current_codigo_venda = $row['codigo_venda'];
                            $nome_cliente = $row['nome_cliente'];
                            $data_venda = $row['data_venda'];
                        }

                        $produtos[] = "{$row['nomecerveja']} (Qtd: {$row['quantidade']}, Valor: R$ {$row['valor_unitario']})";
                        $quantidade_total += $row['quantidade'];
                        $valor_total += $row['valor_total'];
                    }

                    echo "<tr>";
                    echo "<th scope='row'>{$current_codigo_venda}</th>";
                    echo "<td>{$nome_cliente}</td>";
                    echo "<td><ul>";
                    foreach ($produtos as $produto) {
                        echo "<li>{$produto}</li>";
                    }
                    echo "</ul></td>";
                    echo "<td>{$quantidade_total}</td>";
                    echo "<td>R$ " . number_format($valor_total, 2, ',', '.') . "</td>";
                    echo "<td>{$data_venda}</td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='6'>Nenhuma venda encontrada</td></tr>";
                }
                $conn->close(); // Fecha a conexão com o banco de dados
                ?>
            </tbody>
        </table>
    </div>
    </main>
</body>
</html>
