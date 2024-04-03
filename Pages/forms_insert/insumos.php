<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Insumos</title>
</head>

<body>
    <form action="http://localhost/6-BALAS/DB_php/INSERT/inserir_insumo.php" method="POST">
        <div class="form-header">
            <div class="title">
                <h1>Escolha Seu Produto</h1>
            </div>
        </div>

        <div class="input-group">
            <div class="input-box">
                <label for="codfornecedor">Código Fornecedor</label>
                <input type="text" name="codfornecedor" id="codfornecedor" placeholder="Código do Fornecedor" required>
            </div>

            <select name="insumo" id="insumo">
                <option value="">Selecione um Insumo</option>
                <option value="malte">Malte</option>
                <option value="lupulo">Lupulo</option>
                <option value="trigo">Trigo</option>
                <option value="levadura">Levadura</option>
                <option value="acucar">Açúcar</option>
                <option value="agua">Água</option>
            </select>

            <div class="quantidade-group">
                <select name="quantidade" id="quantidade" required>
                    <option value="">Selecione a quantidade</option>
                    <option value="kg">Kg</option>
                    <option value="litros">Litros</option>
                </select>
            </div>

            <div class="comprar-button">
                <button type="submit">COMPRAR</button>
            </div>
        </div>
    </form>
</body>

</html>
