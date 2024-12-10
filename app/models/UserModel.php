<?php

require_once '../app/database/connection.php';

class User
{
    private $db;

    public function __construct(){
        $this->db = Connection::getInstance();
    }

    public function register($nome, $email, $password)
    {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (nome, email, password, role_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare(query: $sql);
        return $stmt->execute(params: [
            ':nome' => $nome, 
            ':email' => $email, 
            ':password' => $hashedPassword, 
            $roleId
        ]);
    }

    public function login($email, $password)
    {
        
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    public function getRole($roleId)
    {
        
        $sql = "SELECT nome FROM roles WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$roleId]);
        $role = $stmt->fetch();
        return $role['nome'];
    }
}
