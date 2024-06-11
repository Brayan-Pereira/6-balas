<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrar Novo Lote de Cerveja</title>
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
                    <li><a onclick="verificacao()"
                            href="http://localhost/6-balas/Pages/admin/admin.html">Área do
                            administrador</a></li>
                </ul>
            </section>
        </nav>

        <div class="logo">
            <img src="http://localhost/6-BALAS/Components/header/logo/logo.png" alt="">
        </div>
    </header>

    <main>
        <h1>Registrar Novo Lote de Cerveja</h1>
        <form action="http://localhost/6-BALAS/DB_php/INSERT/registrar_lote.php" method="POST">
            <label for="produto">Selecione o Produto:</label>
            <select name="produto" id="produto" required>
                <?php
                // Conectar ao banco de dados
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "cerveja";
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Checar conexão
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Consulta para obter os produtos
                $sql = "SELECT id, nomecerveja FROM produtos";
                $result = $conn->query($sql);

                // Verificar se a consulta retornou linhas
                if ($result->num_rows > 0) {
                    // Iterar sobre os resultados e criar uma opção para cada linha
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["id"] . '">' . $row["nomecerveja"] . '</option>';
                    }
                } else {
                    echo '<option>Não há produtos disponíveis</option>';
                }

                // Fechar conexão
                $conn->close();
                ?>
            </select>
            <br>
            <label for="data_elaboracao">Data de Elaboração:</label>
            <input type="date" name="data_elaboracao" id="data_elaboracao" required>
            <br>
            <button type="submit">Registrar Lote</button>
        </form>
    </main>
</body>

</html>
