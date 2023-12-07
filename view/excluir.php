<?php
session_start();

if (isset($_POST['id'])) {
    $idLivroExcluir = $_POST['id'];

    if (isset($_SESSION['favorito'][$idLivroExcluir])) {
        unset($_SESSION['favorito'][$idLivroExcluir]);
    }
}
?>