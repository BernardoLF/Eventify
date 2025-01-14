<?php

require_once './app/database/connection.php';

class Registo {

    private $db;

    public function __construct(){
        // Inicializa a conexão com o banco de dados
        $this->db = Connection::getInstance();
    }

    public function getAllRegistos(){

        $sql = "SELECT registo.*, 
                eventos.titulo AS nome_evento, 
                users.nome AS nome_utilizador
                FROM registo
                LEFT JOIN eventos ON registo.id_evento = eventos.id
                LEFT JOIN users ON registo.id_user = users.id";
        // Prepara a consulta SQL
        $stmt = $this->db->prepare($sql);
        // Executa a consulta
        $stmt->execute();
        // Retorna os eventos como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 

    }
    
    public function getAllRegistoById($id){

        $sql = "SELECT registo.*, 
                eventos.titulo AS nome_evento, 
                users.nome AS nome_utilizador
                FROM registo
                LEFT JOIN eventos ON registo.id_evento = eventos.id
                LEFT JOIN users ON registo.id_user = users.id
                WHERE registo.id_user = :id_user";
        // Prepara a consulta SQL
        $stmt = $this->db->prepare($sql);
        // Executa a consulta
        $stmt->execute([
            ':id_user' => $id
        ]);
        // Retorna os eventos como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 

    }

}
?>