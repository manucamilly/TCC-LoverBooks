<?php
    require_once('../action/cadastro_login.php');
    require_once('../database/conexao.php');

    $database = new Conexao();
    $db = $database->getConnection();
    $cadastro_login = new Usuario($db);

    if(isset($_POST['cadastrar'])){
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($cadastro_login->cadastrar($fullname, $username, $email, $password)){
            header("Location: ../public/index.php");
            exit;
        }
    }
?>

<!DOCTYPE html> <!--Documento HTML-->
<html lang="pt-BR"> <!--Página em Português-BR-->

<head> <!--Cabeça-Funções internas-->
    <meta charset="UTF-8"> <!--Caractéres especiais-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Proporção p.diferentes dimensões d.telas-->
    <link href="https://fonts.googleapis.com/css?family=Jacques+Francois+Shadow|Alice"> <!--Importando fontes-->
    <link rel="stylesheet" href="../public/CSS/normalize.css"> <!--Importando estilizações-->
    <link rel="stylesheet" href="../public/CSS/cadastrar.css">
    <title>Cadastrar</title> <!--Título-Guia d.navegação-->
</head>

<!--Corpo-->
<body>
    <!--Cabeçalho-->
    <header>
        <h1>LoverBooks</h1> <!--Título-Cabeçalho-->
    </header>

    <div class="login-container"> <!--Recipiente-Formulário-->
        <form method="POST"> <!--Formulário-->
            <h2>CADASTRE-SE</h2> <!--Título-Formulário-->

            <input type="text" id="fullname" name="fullname" placeholder="Nome completo" required> <!--Campo d.preenchimento-->
            <input type="text" id="username" name="username" placeholder="Nome de usuário" required>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
            <input type="password" id="password" name="password" placeholder="Senha" required>

            <button type="submit" name="cadastrar">Criar conta</button> <!--Botão-->
        </form>
        <a href="../public/index.php">Voltar para o login</a> <!--Link-Direciona à pág.Index-->
    </div>

    <!--Rodapé-->
    <footer>
        <p>&copy; 2023 - Direitos Reservados Anna&Emanuelle</p>
    </footer>
</body>
</html> <!--Fim d.página-->