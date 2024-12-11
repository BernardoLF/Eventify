<?php

require_once '../app/database/connection.php';

class Auth{

    private $db;

    public function __construct(){
        $this->db = Connection::getInstance();
    }

    public function insertUser($nome, $email, $password): bool{

        $sql = "INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)";

        $stmt = $this->db->prepare(query: $sql);

        return $stmt ->execute(params: [
            ':nome' => $nome,
            ':email' => $email,
            ':password' => $password
        ]);
    }

    public function getUser($email, $password): array{

        $sql = "SELECT email FROM users WHERE email = $user AND password = $pass";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return ['error' => 'Credenciais inválidas']; // Retorna um array com um erro
    }

    public function getRole($roleId)
    {
        
        $sql = "SELECT nome FROM roles WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$roleId]);
        $role = $stmt->fetch();
        return $role['nome'];
    }
}
