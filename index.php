<?php
$error_message = '';

if (isset($_POST['login'])) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=psibd", "root", "mysql");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $error_message = 'Erro de conexão com o banco de dados: ' . $e->getMessage();
    }
    
    if (!$error_message) {
        $emailOrUsername = $_POST['email_or_username'];
        $password = $_POST["pass"];
        
        // Verifica se o email ou username existe no banco de dados
        $sql = 'SELECT * FROM user WHERE (email = ? OR username = ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$emailOrUsername, $emailOrUsername]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || !password_verify($password, $user['password'])) {
            $error_message = "Falha ao logar-se, email, username ou senha incorretos!";
        } else {
            header('Location: entrada.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('https://www.topgear.com/sites/default/files/2022/10/1%20Porsche%20911%20GT3%20RS.jpg?w=892&h=502'); /* Substitua pelo caminho da sua imagem */
            background-size: cover;
            background-position: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: calc(100% - 22px); /* Subtraindo o espaço ocupado pela borda */
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

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        if (!empty($error_message)) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        ?>
        <form method="post" action="index.php">
            <label>Email ou Username:</label>
            <input type="text" name="email_or_username" required><br>
            <label>Senha:</label>
            <input type="password" name="pass" required><br>
            <input type="submit" name="login" value="Login">
        </form>
        <p>Ainda não tem uma conta? <a href="register.php">Registre-se aqui</a></p>
    </div>
</body>
</html>
