<?php
session_start();

require_once('../action/contas.php');
require_once('../database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$usuario = new Usuario($db);


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($usuario->login($username, $password)) {
        $user_info = $usuario->getUserInfo($username);

        if ($user_info['adm'] == 'administrador') {
            $_SESSION['user_role'] = 'administrador';
            header("Location: admin_dashboard.php");
        } elseif ($user_info['adm'] == 'comum') {
            $_SESSION['user_role'] = 'comum';
            header("Location: ../public/index.php");
        } else {
            print "<script>alert('Nível de acesso inválido!')</script>";
        }
        exit();
    } else {
        print "<script>alert('Credenciais Inválidas!')</script>";
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
    <link rel="stylesheet" href="../public/CSS/logar.css">
    <link rel="icon" href="../public/img/Logo.svg" type="image/svg">
    <title>Login</title>
</head>

<body>
    <header>
        <h1>LoverBooks</h1>
    </header>

    <div class="login-container">
        <form method="POST">
            <h2>LOGIN</h2>

            <input type="text" id="username" name="username" placeholder="Nome de usuário" required>
            <input type="password" id="password" name="password" placeholder="Senha" required>

            <button type="submit" name="login">Entrar</button>

            <a href="forgotpassword.php">Esqueceu a senha?</a>
            <a href="cadastrar.php">Criar conta</a>
        </form>
    </div>

    <footer>
        <p>&copy; 2023 - Direitos Reservados Anna&Emanuelle</p>
    </footer>
</body>
</html>