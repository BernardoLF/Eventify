<?php

require_once './app/database/connection.php';

class Dashboard {

    private $db;

    public function __construct() {
        // Conexão com a base de dados
        $this->db = Connection::getInstance();
    }

    // Método para buscar os eventos
    public function getEventos() {
        // Corrigir nome da coluna para 'data'
        $query = "SELECT * FROM eventos ORDER BY data ASC"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna os eventos como um array associativo
    }
}

?>
