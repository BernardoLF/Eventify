<?php

require_once './app/database/connection.php';

class User {

    private $db;

    public function __construct() {
        // Conexão com a base de dados
        $this->db = Connection::getInstance();
    }

    // Método para buscar um usuário pelo ID
    public function getUser($id): ?array {
        // SQL para selecionar todos os dados do usuário com base no ID
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        // Executa a consulta passando o ID do usuário
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retorna o ID da função do usuário
        return ['role_id' => $user['role_id']];
    }

    // Método para buscar todos os usuários
    public function getAllUsers(): ?array {
        // SQL para selecionar todos os usuários e suas funções
        $sql = "SELECT users.*, 
                       roles.nome AS role 
                FROM users 
                LEFT JOIN roles ON users.role_id = roles.id";

        $stmt = $this->db->prepare($sql);
        // Executa a consulta
        $stmt->execute();
        // Retorna todos os usuários como um array associativo
        return $stmt->fetchAll();
    }

    // Método para alterar a função de um usuário
    public function changeRole($userId, $newRoleId) {
        // SQL para atualizar a função do usuário
        $query = "UPDATE users SET role_id = :role_id WHERE id = :id";
        $stmt = $this->db->prepare($query);
        // Vincula os parâmetros da consulta
        $stmt->bindParam(':role_id', $newRoleId);
        $stmt->bindParam(':id', $userId);
        // Executa a atualização e retorna o resultado
        return $stmt->execute();
    }

}

?>