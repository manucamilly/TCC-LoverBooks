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
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../public/CSS/dashboard.css">
    <link rel="icon" href="../public/img/Logo.svg" type="image/svg">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
        }

        h1 {
            margin-top: 54px;
            text-align: center;
        }

        .product-card {
            z-index: 1;
            position: relative;
            width: 94%;
            display: flex;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
        }

        .product-card img {
            max-width: 100px;
            height: auto;
            margin-right: 10px;
        }

        .product-details {
            flex: 1;
        }

        .product-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 16px;
            font-weight: bold;
        }

        .remove-button {
            font-size: 14px;
            color: red;
            cursor: pointer;
        }

        .empty-cart-message {
            inset: 182px;
            position: absolute;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <?php include_once('components/header.php'); ?>

    <button id="Inicio"><a href="../public/index.php"></a></button>
    <button id="Menu"></button>

    <div class="container">
        <h1>Seus Favoritos</h1>
        <?php
        if ($id !== "" && isset($livros[$id])) {
            $favorito = new Favorito(
                $id,
                $livros[$id]['titulo'],
                $livros[$id]['capa_livro'],
            );
            $favorito->getFavorito();
        } else {
            echo '  ';
        }
        if (!empty($_SESSION['favorito'])) {
            foreach ($_SESSION['favorito'] as $livro => $value) {
        ?>
                <div class="product-card">
                    <img src="<?= $value['capa_livro'] ?>" alt="Capa do Livro">
                    <div class="product-details">
                        <div class="product-title"><?= $value['titulo'] ?></div>
                        <div class="remove-button" data-id="<?= $livro ?>">Remover</div>
                    </div>
                </div>
        
        <?php
            }
            echo '<div class="empty-cart-message">Você ainda não tem favoritos!</div>';
        }
        ?>

    <script src="JS/script.js"></script>
</body>
<script>
    $(document).ready(function() {
        $(".remove-button").click(function() {
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
</html>