<?php
// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=localhost;dbname=psibd", "root", "mysql");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

// Consulta para recuperar produtos no carrinho do usuário
$user_id = 1; // Defina o ID do usuário, por exemplo
$sql = "SELECT * FROM carrinhocompras WHERE IDUser = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
</head>
<body>
    <h2>Carrinho de Compras</h2>
    <?php if (empty($cart_items)): ?>
        <p>O seu carrinho está vazio.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($cart_items as $item): ?>
                <li><?php echo $item['NomeProduto']; ?> - €<?php echo number_format($item['PrecoProduto'], 2); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
