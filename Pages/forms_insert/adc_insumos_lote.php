<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrar Insumos em Lote</title>

    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/global.css">
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/header.css">
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/main.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        body {
            background-color: #000000;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 10px 20px;
        }

        main {
            padding-top: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            margin-bottom: 40px;
            font-size: 2rem;
            text-align: center;
        }

        form {
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            width: 100%;
            max-width: 500px;
        }

        form label {
            font-size: 1.1rem;
            margin-bottom: 5px;
            display: block;
        }

        form select,
        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        form select {
            background-color: #333;
            color: #fff;
        }

        form input {
            background-color: #444;
            color: #fff;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        form button:hover {
            background-color: #45a049;
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
                    <li><a href="http://localhost/6-balas/index.html">Tela inicial</a></li>
                    <li><a onclick="verificacao()" href="http://localhost/6-balas/Pages/admin/admin.html">Área do administrador</a></li>
                </ul>
            </section>
        </nav>

        <div class="logo">
            <img src="http://localhost/6-BALAS/Components/header/logo/logo.png" alt="">
        </div>
    </header>

    <main>
        <h1>Adicionar Insumos a um Lote</h1>
        <form action="http://localhost/6-BALAS/DB_php/INSERT/adicionar_insumos.php" method="POST">
            <label for="lote">Selecione o Lote:</label>
            <select name="lote" id="lote" required>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "cerveja";
                // Conectar ao banco de dados
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Checar conexão
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // Consulta para obter os lotes
                $sqlLotes = "SELECT id, data_elaboracao FROM lotes_cerveja";
                $resultLotes = $conn->query($sqlLotes);
                // Verificar se a consulta retornou linhas
                if ($resultLotes->num_rows > 0) {
                    // Iterar sobre os resultados e criar uma opção para cada linha
                    while ($rowLote = $resultLotes->fetch_assoc()) {
                        echo '<option value="' . $rowLote["id"] . '">Lote ' . $rowLote["id"] . ' - ' . $rowLote["data_elaboracao"] . '</option>';
                    }
                } else {
                    echo '<option>Não há lotes disponíveis</option>';
                }
                ?>
            </select>
            <label for="insumo">Selecione o Insumo:</label>
            <select name="insumo" id="insumo" required>
                <?php
                // Consulta para obter os insumos
                $sqlInsumos = "SELECT id, insumo FROM insumos";
                $resultInsumos = $conn->query($sqlInsumos);
                // Verificar se a consulta retornou linhas
                if ($resultInsumos->num_rows > 0) {
                    // Iterar sobre os resultados e criar uma opção para cada linha
                    while ($rowInsumo = $resultInsumos->fetch_assoc()) {
                        echo '<option value="' . $rowInsumo["id"] . '">' . $rowInsumo["insumo"] . '</option>';
                    }
                } else {
                    echo '<option>Não há insumos disponíveis</option>';
                }
                ?>
            </select>
            <label for="quantidade">Quantidade Utilizada:</label>
            <input type="number" step="0.01" name="quantidade" id="quantidade" required>
            <button type="submit">Adicionar Insumo ao Lote</button>
        </form>
    </main>
</body>

</html>
