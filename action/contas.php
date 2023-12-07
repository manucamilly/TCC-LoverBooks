<?php
include('../database/conexao.php');

$db = new Conexao();

class Usuario{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    public function getUserInfo($username) {
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        if($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function cadastrar($fullname, $username, $email, $password){
            $usernameExistente = $this->verificarUsernameExistente($username);

            if($usernameExistente){
                print"<script>alert('Nome de usuário já cadastrado!')</script>";
                return false;
            }

            $emailExistente = $this->verificarEmailExistente($email);

            if($emailExistente){
                print"<script> alert('Email já cadastrado!')</script>";
                return false;
            }

            $senhacriptografada = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (fullname, username, email, password) VALUES (?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1,$fullname);
            $stmt->bindValue(2,$username);
            $stmt->bindValue(3,$email);
            $stmt->bindValue(4,$senhacriptografada);
            $result = $stmt->execute();

            return $result;
        }

        private function verificarUsernameExistente($username){
            $sql = "SELECT COUNT(*) FROM usuarios WHERE username = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1,$username);
            $stmt->execute();

            return $stmt->fetchColumn() > 0;
        }

        private function verificarEmailExistente($email){
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1,$email);
            $stmt->execute();

            return $stmt->fetchColumn() > 0;
        }

        public function login($username, $password){
            $sql =  "SELECT * FROM usuarios WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':username',$username);
            $stmt->execute();

            if($stmt->rowCount() == 1){
                $username = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $username['password'])){
                    return true;
                }
            }

            return false;
        }
}
