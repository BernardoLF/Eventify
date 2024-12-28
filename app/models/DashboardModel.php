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
        // Corrigir para incluir dados da tabela 'data_hora' usando JOIN
        $query = "SELECT eventos.*, 
                         data_hora.data_inicio AS data_inicio, 
                         data_hora.data_encerramento AS data_encerramento, 
                         data_hora.hora_abertura AS hora_abertura, 
                         data_hora.hora_encerramento AS hora_encerramento
                  FROM eventos
                  LEFT JOIN data_hora ON eventos.id_days = data_hora.id
                  ORDER BY data_inicio ASC"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna os eventos como um array associativo
    }

    
}

?>
