<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../public/index.php");
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Jacques+Francois+Shadow|Alice">
    <link rel="stylesheet" href="../public/CSS/dashboard.css">
    <title>LoverBooks</title>
</head>

<body>
    <header>
        <h1>LoverBooks</h1>
    </header>

    <button id=Lupa></button>
    <button id=Menu></button>

    <div class=Livros>
        <a id=Livro1 href="livro.php"></a>
        <a id=Livro2 href="livro.php"></a>
        <a id=Livro3 href="livro.php"></a>
        <a id=Livro4 href="livro.php"></a>
        <a id=Livro5 href="livro.php"></a>
        <a id=Livro6 href="livro.php"></a>
        <a id=Livro7 href="livro.php"></a>
        <a id=Livro8 href="livro.php"></a>
        <a id=Livro9 href="livro.php"></a>
        <a id=Livro10 href="livro.php"></a>
        <a id=Livro11 href="livro.php"></a>
        <a id=Livro12 href="livro.php"></a>
    </div>
</body>
</html>