<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'psibd';
$usuario = 'root';
$senha = 'mysql';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Erro de conexão com o banco de dados: ' . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .product {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .product img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .product h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .product p {
            margin-bottom: 10px;
        }
        .product .price {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <?php
    // Consulta ao banco de dados para obter os produtos
    $sql = "SELECT * FROM produtos";
    $stmt = $pdo->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Exibição dos produtos
    foreach ($produtos as $produto) {
        echo '<div class="product">';
        echo '<img src="' . $produto["imagem"] . '" alt="' . $produto["descricao"] . '">';
        echo '<h3>' . $produto["descricao"] . '</h3>';
        echo '<p>' . $produto["descricao_completa"] . '</p>';
        echo '<p class="price">R$ ' . number_format($produto["preco"], 2, ',', '.') . '</p>';
        echo '</div>';
    }
    ?>
</body>
</html>
