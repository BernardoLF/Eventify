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
        // SQL para buscar eventos e dados relacionados da tabela 'data_hora' usando JOIN
        $sql = "SELECT eventos.*, 
                         data_hora.data_inicio AS data_inicio, 
                         data_hora.data_encerramento AS data_encerramento, 
                         data_hora.hora_abertura AS hora_abertura, 
                         data_hora.hora_encerramento AS hora_encerramento,
                         categorias.nome as categoria
                  FROM eventos
                  LEFT JOIN data_hora ON eventos.id_days = data_hora.id
                  LEFT JOIN categorias ON eventos.id_categoria = categorias.id 
                  ORDER BY data_inicio ASC"; 
        // Prepara a consulta SQL
        $stmt = $this->db->prepare($sql);
        // Executa a consulta
        $stmt->execute();
        // Retorna os eventos como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

}

?>