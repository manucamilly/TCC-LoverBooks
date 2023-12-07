<?php
session_start();

require_once('../action/contas.php');
require_once('../database/conexao.php');
require_once('../action/favorito.php');

$database = new Conexao();
$db = $database->getConnection();

$livros = [];

$query = "SELECT * FROM livros";
$result = $db->query($query);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $livros[] = $row;
    }
}

$id = isset($_GET['id']) ? $_GET['id'] : "";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Jacques+Francois+Shadow|Alice">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="icon" href="../public/img/Logo.svg" type="image/svg">
    <title>LoverBooks</title>
</head>

<body>

    <?php include '../view/components/header.php'; ?>

    <button id="Lupa"></button>
    <button id="Menu"></button>

    <div class="menuBarra">
        <a id="Links" href="../view/logar.php">Login</a><br>
        <a id="Links" href="../view/cadastrar.php">Cadastro</a><br>
        <a id="Links" href="../view/favorito.php">Favoritos</a><br>
    </div>

    <div class="Livros">
        <?php foreach ($livros as $livro => $value) : ?>
            <div class="container">
                <a id="Livro" href="../view/livro.php?id=<?= $value["id"] ?>" style="background-image: url(<?= $value["capa_livro"] ?>);"></a>
                <a id="Favorito" href="?id=<?= $livro ?>"></a>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    if ($id !== "" && isset($livros[$id])) {
        $favorito = new Favorito($id, $livros[$id]['titulo'], $livros[$id]['capa_livro']);
        $favorito->getFavorito();

        // if (isset($_SESSION['favorito']) && is_array($_SESSION['favorito'])) {
        //     foreach ($_SESSION['favorito'] as $livro => $value) {
        //         // echo "<p> Id do Livro: " . $value['id'] . " | 
        //         //             Nome do Livro: " . $value['titulo'] . " | 
        //         //             Capa do Livro: " . $value['capa_livro'] .
        //         //     "</p><br>";
        //         // echo "<a href='javascript:void(0);' class='excluir-livro' data-id='{$livro}'>Excluir</a>";
        //     }
        // } else {
        //     $_SESSION['livro'] = array();
        //     echo "";
        // }
    }
    ?>
    <script>
        $(document).ready(function() {
            $(".excluir-livro").click(function() {
                var idLivro = $(this).data("id");

                $.ajax({
                    url: "excluir.php", 
                    type: "POST",
                    data: {
                        id: idLivro
                    },
                    success: function(response) {
                        
                        location.reload(); 
                    },
                    error: function(xhr, status, error) {
                        
                        console.error(error);
                    },
                });
            });
        });
    </script>

    <script src="JS/script.js"></script>
</body>
</html>