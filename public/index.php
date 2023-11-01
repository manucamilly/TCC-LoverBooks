<?php
session_start();

require_once('../action/cadastro_login.php');
require_once('../database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$usuario = new Usuario($db);

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($usuario->login($username, $password)){
        $_SESSION['username'] = $username;
        header("Location: ../view/dashboard.php");
        exit();
    }else{
        print "<script>alert('Credenciais Inválidas!')</script>";
    }
}
?>

<!DOCTYPE html> <!-- Documento HTML -->
<html lang="pt-BR"> <!-- Página em Português-BR -->

<head> <!--Cabeça-Funções internas-->
<meta charset="UTF-8"> <!-- Caractéres especiais -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Proporção de Tela -->
    <link href="https://fonts.googleapis.com/css?family=Jacques+Francois+Shadow|Alice"> <!--Importando fontes-->
    <link rel="stylesheet" href="CSS/normalize.css"> <!--Importando estilizações-->
    <link rel="stylesheet" href="CSS/index.css">
    <title>Login</title> <!--Título-Guia d.navegação-->
</head>

<!--Corpo-->
<body>
    <!--Cabeçalho-->
    <header>
        <h1>LoverBooks</h1> <!--Título-Cabeçalho-->
    </header>

    <div class="login-container"> <!--Recipiente-Formulário-->
        <form method="POST"> <!--Formulário-->
            <h2>LOGIN</h2> <!--Título-Formulário-->

            <input type="text" id="username" name="username" placeholder="Nome de usuário" required> <!--Campo d.preenchimento-->
            <input type="password" id="password" name="password" placeholder="Senha" required>

            <button type="submit" name="login">Entrar</button> <!--Botão-->

            <a href="../view/forgotpassword.php">Esqueceu a senha?</a> <!--Link-Direciona à 'forgortpassword.php'-->
            <a href="../view/cadastrar.php">Criar conta</a> <!--Link-Direciona à 'cadastrar.php'-->
        </form>
    </div>

    <!--Rodapé-->
    <footer>
        <p>&copy; 2023 - Direitos Reservados Anna&Emanuelle</p>
    </footer>
</body>
</html> <!--Fim d.página-->