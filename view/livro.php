<?php
session_start();

require_once('../database/conexao.php');
require_once('../action/crud_livros.php');

$database = new Conexao();
$db = $database->getConnection();
$crud = new Crud($db);
$book = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM livros WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Livro não encontrado!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Jacques+Francois+Shadow|Alice">
    <link rel="stylesheet" href="../public/CSS/livro.css">
    <link rel="icon" href="../public/img/Logo.svg" type="image/svg">
    <title>LoverBooks</title>
</head>

<body>
    <!--Cabeçalho-->
    <?php include 'components/header.php'; ?>

    <button id="Inicio"><a href="../public/index.php"></a></button>
    <button id="Menu"></button>

    <main>
        <div class="Conteudo">
            <img  src="<?php echo $book["capa_livro"]; ?>">

            <div class="Ficha">
                <h1>Ficha Técnica</h1>
                <p><span>Título: </span><?php echo $book["titulo"]; ?></p>
                <p><span>Autor(a): </span><?php echo $book["autor"]; ?></p>
                <p><span>Ano de lançamento: </span><?php echo $book["ano_lancamento"]; ?></p>
                <p><span>Gênero: </span><?php echo $book["genero"]; ?></p>
                <p><span>Classificação indicativa: </span><?php echo $book["classificacao"]; ?></p>
                <p><span>Avaliação: </span><?php echo $book["avaliacao"]; ?></p>
            </div>

            <div class="Resenha">
                <h1 id="Titulo"><?php echo $book["titulo"]; ?></h1>
                <p id=Resenha><?php echo $book["resenha"]; ?></p>
                <p><span>Públicado em: </span><?php echo $book["data_cadastro"]; ?></p>
            </div>
        </div>
    </main>

    <footer>
        <p id="Copyright">&copy;2023 - Direitos Reservados LoverBooks</p>
    </footer>
</body>
</html>