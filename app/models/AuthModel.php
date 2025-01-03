<?php

require_once './app/database/connection.php';

class Auth{

    private $db;

    public function __construct(){
        $this->db = Connection::getInstance();
    }

    public function insertUser($nome, $email, $password): bool{

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)";

        $stmt = $this->db->prepare(query: $sql);

        return $stmt->execute(params: [
            ':nome' => $nome,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    public function verificarLogin($email, $password): ?array {    
        
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null; // Usuário não encontrado
        }
        
        // Verificação explícita da senha
        $senhaCorreta = password_verify($password, $user['password']);
            if (!$senhaCorreta) {
                return null;

            }

            return ['nome' => $user['nome'], 'id' => $user['id'], 'autenticado' => true]; // Retorna o nome e status de autenticação
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