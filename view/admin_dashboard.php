<?php
require_once('../action/contas.php');
require_once('../database/conexao.php');
require_once('../action/crud_livros.php');

$database = new Conexao();
$db = $database->getConnection();
$crud = new Crud($db);

if(isset($_GET['action'])){
    switch($_GET['action']){
        case 'create':
            $crud->create($_POST);
            $rows = $crud->read();
            break;

        case 'read':
            $rows = $crud->read();
            break;

        case 'update':
            if(isset($_POST['id'])){
                $crud->update($_POST);
            }
            $rows = $crud->read();
            break;

        case 'delete':
            $crud->delete($_GET['id']);
            $rows = $crud->read();
            break;

        default:
            $rows = $crud->read();
            break;

    }
}else{
    $rows = $crud->read();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/CSS/admin_dashboard.css">
    <title>Crud</title>
    <style>
        form{
            max-width:500px;
            margin:0 auto;
        }

        label{
            display: flex;
            margin-top:10px;
        }

        input[type=text]{
            width:100%;
            padding:12px 20px;
            margin:8px 0;
            display: inline-block;
            border:1px solid #ccc;
            border-radius:4px;
            box-sizing:border-box;
        }

        input[type=submit]{
            background-color:#4caf50;
            color:white;
            padding:12px 20px;
            border:none;
            border-radius:4px;
            cursor:pointer;
            float:right;
        }

        input[type=submit]:hover{
            background-color:#45a049;
        }

        table{
            border-collapse:collapse;
            width:100%;
            font-family:Arial, sans-serif;
            font-size:14px;
            color:#333;
        }

        th, td{
            text-align:left;
            padding:8px;
            border:1px solid #333;
        }

        th{
            background-color:#f2f2f2f2;
            font-weight:bold;
        }

        a{
            display:inline-block;
            padding:4px 8px;
            background-color:#007bff;
            color:#fff;
            text-decoration:none;
            border-radius:4px;
        }

        a:hover{
            background-color:#0069d9;
        }

        a.delete{
            background-color:#dc3545;
        }

        a.delete:hover{
            background-color:#c82333;
        }
    </style>
</head>
<body>

    <?php
    if(isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])){
        $id = $_GET['id'];
        $result = $crud->readOne($id);

        if(!$result){
            echo "Registro não encontrado.";
            exit();
        }
        $titulo = $result['titulo'];
        $capa_livro = $result['capa_livro'];
        $genero = $result['genero'];
        $ano_lancamento = $result['ano_lancamento'];
        $autor = $result['autor'];
        $avaliacao = $result['avaliacao'];
        $classificacao = $result['classificacao'];
        $resenha = $result['resenha'];
        $data_cadastro = $result['data_cadastro'];
    ?>

    <form action="?action=update" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" value="<?php echo $titulo ?>">
        
        <label for="capa_livro">Capa do Livro</label>
        <input type="text" name="capa_livro" value="<?php echo $capa_livro ?>">

        <label for="genero">Gênero</label>
        <input type="text" name="genero" value="<?php echo $genero ?>">

        <label for="ano_lancamento">Ano de Lançamento</label>
        <input type="number" min="1500" max="2023" name="ano_lancamento" required value="<?php echo $ano_lancamento ?>"><br>

        <label for="autor">Autor</label>
        <input type="text" name="autor" value="<?php echo $autor ?>"><br>

        <label for="avaliacao">Avaliação</label>
        <input type="text" name="avaliacao" value="<?php echo $avaliacao ?>"><br>

        <label for="classificacao">Classificação</label>
        <input type="text" name="classificacao" value="<?php echo $classificacao ?>"><br>

        <label for="resenha">Resenha</label>
        <textarea id="resenha" name="resenha" value="<?php echo $resenha ?>"></textarea><br>

        <label for="data_cadastro">Data do Cadastro</label>
        <input type="text" name="data_cadastro" value="<?php echo $data_cadastro ?>"><br>

        <input type="submit" value="Atualizar" name="enviar" onclick="return confirm('Certeza que deseja atualizar?')">

    </form>

    <?php
        } else {
    ?>

    <form action="?action=create" method="POST" enctype="multipart/form-data">
        <h1>Ficha técnica</h1>

        <label for="titulo">Título do livro:</label>
        <input type="text" name="titulo" required><br>

        <label for="capa_livro">Capa do livro:</label>
        <input type="file" name="capa_livro" required><br>
        
        <label for="genero">Gênero</label>
        <select name="genero" required>
            <option value="Romance">Romance</option>
            <option value="Comédia">Comédia</option>
            <option value="Terror">Terror</option>
            <option value="Fantasia">Fantasia</option>
            <option value="Ficção">Ficção</option>
            <option value="Aventura">Aventura</option>
            <option value="Poesia">Poesia</option>
            <option value="Drama">Drama</option>
            <option value="Ação">Ação</option>
            <option value="Auto-Ajuda">Auto-Ajuda</option>
        </select><br>

        <label for="ano_lancamento">Ano de lançamento:</label>
        <input type="number" min="1500" max="2023" name="ano_lancamento" required><br>

        <label for="autor">Autor(a):</label>
        <input type="text" name="autor" required><br>

        <label for="avaliacao">Avaliação geral:</label>
        <input type="number" min="1" max="5" name="avaliacao" required><br>

        <label for="classificacao">Classificação indicativa:</label>
        <input type="text" name="classificacao" required><br>

        <h2>Resenha</h2>
        <label for="resenha">Resenha:</label><br>
        <textarea id="resenha" name="resenha"></textarea><br>

        <button type="submit" name="cadastrar">Cadastrar livro</button>
    </form>

    <?php
        }
    ?>

    <table>
        <tr>
            <td>ID</td>
            <td>Título</td>
            <td>Capa do Livro</td>
            <td>Gênero</td>
            <td>Ano de lançamento</td>
            <td>Autor</td>
            <td>Avaliação</td>
            <td>Classificação</td>
            <td>Resenha</td>
            <td>Data de cadastro</td>
        </tr>

        <?php
        if(isset($rows)){
            foreach($rows as $row){
                echo "<tr>";
                echo "<td>". $row['id']. "</td>";
                echo "<td>". $row['titulo']. "</td>";
                echo "<td>". $row['capa_livro']. "</td>";
                echo "<td>". $row['genero']. "</td>";
                echo "<td>". $row['ano_lancamento']. "</td>";
                echo "<td>". $row['autor']. "</td>";
                echo "<td>". $row['avaliacao']. "</td>";
                echo "<td>". $row['classificacao']. "</td>";
                echo "<td>". $row['resenha']. "</td>";
                echo "<td>". $row['data_cadastro']. "</td>";
                echo "<td>";
                echo "<a href='?action=update&id=". $row['id']."'>Editar</a>";
                echo "<a href='?action=delete&id=". $row['id']."' onclick='return confirm(\"Tem certeza que deseja deletar esse registro?\")' class='delete'>Deletar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "Não há registros a serem exibidos";
        }
        ?>
    </table>
</body>
</html>