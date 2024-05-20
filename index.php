<?php
$error_message = '';

if (isset($_POST['email'])) {
    $pdo = new PDO("mysql:host=localhost;dbname=psibd", "root", "mysql");
    $sql = 'SELECT * FROM user where email=? and Password=?';
    $instrucao = $pdo->prepare($sql);
    $instrucao->execute([
        $_POST['email'],
        $_POST["pass"]
    ]);
    
    if ($instrucao->rowCount() == 0) {
        $error_message = "Falha ao logar-se, email ou password incorrectas!!<br>---<br>";
    } else {
        header('Location: entrada.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro e Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://www.topgear.com/sites/default/files/2022/10/1%20Porsche%20911%20GT3%20RS.jpg?w=892&h=502'); /* Substitua 'caminho/para/sua/imagem.jpg' pelo caminho real da sua imagem */
            background-size: cover; /* Ajusta o tamanho da imagem para cobrir todo o elemento */
            background-position: center; /* Centraliza a imagem no elemento */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .header {
            width: 100%;
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            top: 0;
            font-size: 24px;
        }
        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 80px;
            width: 400px;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 32px;
            color: #333;
        }
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .register-button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }
        .register-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="header">Venda de peças de automóvel</div>
    <form method="post" action="index.php">
        <h2>Login</h2>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Senha:</label>
        <input type="password" name="pass" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <a href="Register.php" class="register-button">Registe se agora</a>
</body>
</html>


