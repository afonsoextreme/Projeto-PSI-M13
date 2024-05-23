<?php
// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=localhost;dbname=psibd", "root", "mysql");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

// Consulta para recuperar produtos
$sql = 'SELECT * FROM produto LIMIT 3';
try {
    $stmt = $pdo->prepare($sql);  // Prepara a consulta SQL
    $stmt->execute();             // Executa a consulta SQL
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Busca os resultados da consulta
} catch (PDOException $e) {
    die("Erro ao executar a consulta SQL: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada</title>
    <style>
        .product {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: inline-block;
            width: 30%; /* Ajuste conforme necessário */
            margin-right: 20px;
            vertical-align: top;
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
    <?php foreach ($products as $product): ?>
        <div class="product">
            <img src="<?php echo htmlspecialchars($product['Imagem']); ?>" alt="Produto">
            <h3><?php echo htmlspecialchars($product['Nome']); ?></h3>
            <p><?php echo htmlspecialchars($product['Descrição']); ?></p>
            <p class="price">R$ <?php echo number_format($product['PrecoUnitario'], 2, ',', '.'); ?></p>
        </div>
    <?php endforeach; ?>

    <!-- Novo produto fornecido -->
    <div class="product">
        <img src="https://cdn.autodoc.de/thumb?id=1060239&m=0&n=0&lng=pt&rev=94077829" alt="Farol Audi Q7">
        <h3>Farol Audi Q7</h3>
        <p>Farol dianteiro para Audi Q7.</p>
        <p class="price">€ 120,00</p>
    </div>
    
        <div class="product">
        <img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQBdhohLvUk5GlNi5UDZb6A-q9JNE9jiebLD_GDTP0vWBf6TGgzX8UIcKpBkugspNxEfEw1G7rKYOnUey4BCRMPqsXBT7sx" alt="Pneu Michelin Sport 4s">
        <h3>Pneu Michelin Sport 4s</h3>
        <p>Pneu Michelin Sport 4s preço por pneu</p>
        <p class="price">€ 290,00</p>
    </div>
    
</body>
</html>
