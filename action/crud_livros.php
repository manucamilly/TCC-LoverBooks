<?php
include_once('../database/conexao.php');

$db = new Conexao();

class Crud{
    private $conn;
    private $table_name = "livros";

    public function __construct($db){
        $this->conn = $db;
    }


    public function create($postValue){
        $titulo = $postValue['titulo'];

        if (isset($_FILES['capa_livro'])) {
            $arquivo = $_FILES['capa_livro'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $ex_permitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'svg');

            if (in_array(strtolower($extensao), $ex_permitidos)) {
                $caminho_arquivo = '../public/bookimg/' . $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo);
            } else {
                die('Você não pode fazer upload desse tipo de arquivo');
            }
        } else {
            $caminho_arquivo = ''; 
        }

        $genero = $postValue['genero'];
        $ano_lancamento = $postValue['ano_lancamento'];
        $autor = $postValue['autor'];
        $avaliacao = $postValue['avaliacao'];
        $classificacao = $postValue['classificacao'];
        $resenha = $postValue['resenha'];

        $query = "INSERT INTO ". $this->table_name . " (titulo, capa_livro, genero, ano_lancamento, autor, avaliacao, classificacao, resenha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$titulo);
        $stmt->bindParam(2,$caminho_arquivo);
        $stmt->bindParam(3,$genero);
        $stmt->bindParam(4,$ano_lancamento);
        $stmt->bindParam(5,$autor);
        $stmt->bindParam(6,$avaliacao);
        $stmt->bindParam(7,$classificacao);
        $stmt->bindParam(8,$resenha);

        $rows = $this->read();
        if($stmt->execute()){
            print "<script>alert('Cadastro Ok!')</script>";
            print "<script> location.href='?action=read'; </script>";
            return true;
        }else{
            return false;
        }
    }


    public function read(){
        $query = "SELECT * FROM ". $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function update($postValue){
        $id = $postValue['id'];
        $titulo = $postValue['titulo'];

        if (isset($_FILES['capa_livro'])) {
            $arquivo = $_FILES['capa_livro'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $ex_permitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'svg');

            if (in_array(strtolower($extensao), $ex_permitidos)) {
                $caminho_arquivo = '../public/bookimg/' . $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo);
            } else {
                die('Você não pode fazer upload desse tipo de arquivo');
            }
        } else {
            $caminho_arquivo = ''; 
        }

        $genero = $postValue['genero'];
        $ano_lancamento = $postValue['ano_lancamento'];
        $autor = $postValue['autor'];
        $avaliacao = $postValue['avaliacao'];
        $classificacao = $postValue['classificacao'];
        $resenha = $postValue['resenha'];
        $data_cadastro = $postValue['data_cadastro'];

        if(empty($id) || empty($titulo) || empty($capa_livro) || empty($genero) || empty($ano_lancamento) || empty($autor) || empty($avaliacao) || empty($classificacao) || empty($resenha) || empty($data_cadastro)){
            return false;
        }

            $query = "UPDATE ". $this->table_name . " SET titulo = ?, capa_livro = ?, genero = ?, ano_lancamento = ?, autor = ?, avaliacao = ?, classificacao = ?, resenha = ?, data_cadastro = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$titulo);
            $stmt->bindParam(2,$caminho_arquivo);
            $stmt->bindParam(3,$genero);
            $stmt->bindParam(4,$ano_lancamento);
            $stmt->bindParam(5,$autor);
            $stmt->bindParam(6,$avaliacao);
            $stmt->bindParam(7,$classificacao);
            $stmt->bindParam(8,$resenha);
            $stmt->bindParam(9,$data_cadastro);
            $stmt->bindParam(10,$id);
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function readOne($id){
            $query = "SELECT * FROM ". $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

}


?>