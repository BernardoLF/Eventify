<?php

require_once './app/database/connection.php';

class User {

    private $db;

    public function __construct() {
        // Conexão com a base de dados
        $this->db = Connection::getInstance();
    }

    // Método para buscar os eventos
    public function getUser($id):?array {

        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return ['role_id' => $user['role_id']];
    }

    public function getAllUsers():?array{
        $sql = "SELECT users.*,
                roles.nome AS role
                FROM users
                LEFT JOIN roles ON users.role_id = roles.id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function changeRole($userId, $newRoleId) {
        $query = "UPDATE users SET role_id = :role_id WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':role_id', $newRoleId);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

}