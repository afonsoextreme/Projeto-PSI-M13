<?php
$error_message = '';
$success_message = '';

if (isset($_POST['register'])) {
    $pdo = new PDO("mysql:host=localhost;dbname=psibd", "root", "mysql");
    
    $email = $_POST['reg_email'];
    $password = password_hash($_POST['reg_pass'], PASSWORD_BCRYPT); // Encrypt password
    
    $sql = 'INSERT INTO user (email, password) VALUES (?, ?)';
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$email, $password]);
        $success_message = "Conta criada com sucesso!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry error code
            $error_message = "Este email já está em uso. Por favor, tente outro.";
        } else {
            $error_message = "Ocorreu um erro: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('https://www.razaoautomovel.com/wp-content/uploads/2024/05/Adamastor-Furia-6.jpg'); /* Substitua o caminho pela localização da sua imagem */
            background-size: cover;
            background-position: center;
        }

        .top-bar {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            width: 100%;
            position: absolute;
            top: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            margin-top: 50px; /* Distância entre o topo e o container */
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

        .success-message {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        Venda de Peças de Automóveis
    </div>
    <div class="container">
        <h2>Registro</h2>
        <?php
        if (!empty($error_message)) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        if (!empty($success_message)) {
            echo '<div class="success-message">' . $success_message . '</div>';
        }
        ?>
        <form method="post" action="register.php">
            <label>Email:</label> 
            <input type="email" name="reg_email" required><br>
            <label>Senha:</label>
            <input type="password" name="reg_pass" required><br>
            <input type="submit" name="register" value="Register">
        </form>
        <p>Já tem uma conta? <a href="index.php">Faça login aqui</a></p>
    </div>
</body>
</html>
