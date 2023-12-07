<?php
    require_once('../action/contas.php');
    require_once('../database/conexao.php');

    $database = new Conexao();
    $db = $database->getConnection();
    $contas = new Usuario($db);

    if(isset($_POST['cadastrar'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($contas->cadastrar($fullname, $username, $email, $password)){
            header("Location: logar.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Jacques+Francois+Shadow|Alice">
    <link rel="stylesheet" href="../public/CSS/normalize.css">
    <link rel="stylesheet" href="../public/CSS/cadastrar.css">
    <title>Cadastrar</title>
</head>

<body>
    <header>
        <h1>LoverBooks</h1>
    </header>

    <div class="login-container">
        <form method="POST">
            <h2>CADASTRE-SE</h2>

            <input type="text" id="fullname" name="fullname" placeholder="Nome completo" required>
            <input type="text" id="username" name="username" placeholder="Nome de usuário" required>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
            <input type="password" id="password" name="password" placeholder="Senha" required>

            <button type="submit" name="cadastrar">Criar conta</button>
        </form>
        <a href="logar.php">Voltar para o login</a>
    </div>

    <footer>
        <p>&copy; 2023 - Direitos Reservados Anna&Emanuelle</p>
    </footer>
</body>
</html>