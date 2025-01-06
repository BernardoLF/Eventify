<?php

require_once './app/database/connection.php';

class Event {

    private $db;

    public function __construct(){
        $this->db = Connection::getInstance();
    }

    public function getEvent($id) {

        $sql = "SELECT eventos.*, 
                         data_hora.data_inicio AS data_inicio, 
                         data_hora.data_encerramento AS data_encerramento, 
                         data_hora.hora_abertura AS hora_abertura, 
                         data_hora.hora_encerramento AS hora_encerramento,
                         categorias.nome as categoria
                  FROM eventos
                  LEFT JOIN data_hora ON eventos.id_days = data_hora.id
                  LEFT JOIN categorias ON eventos.id_categoria = categorias.id
                  WHERE eventos.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bilhete($quantidade, $id){
         // Reduz a quantidade de bilhetes disponíveis
         $sql = "UPDATE eventos SET capacidade = capacidade - :quantidade WHERE id = :id";
         $stmt = $this->db->prepare($sql);
         return $stmt->execute([
         ':quantidade' => $quantidade,
         ':id' => $id
        ]);
    }

    public function insertEvent($titulo, $capacidade, $localizacao, $descricao, $nome_imagem, $categoria, $id_organizador): int{

        // Desativar as restrições de chave estrangeira
        $this->db->exec('SET FOREIGN_KEY_CHECKS=0;');

        // Inserir na tabela de eventos
        $sql = 'INSERT INTO eventos (titulo, descricao, localizacao, capacidade, id_organizador, imagem, id_categoria) VALUES (:titulo, :descricao, :localizacao, :capacidade, :id_organizador, :imagem, :categoria);';
        
        // Executar a inserção na tabela de eventos
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ':titulo' => $titulo,
            ':capacidade' => $capacidade,
            ':localizacao' => $localizacao,
            ':descricao' => $descricao,
            ':imagem' => $nome_imagem,
            ':id_organizador' => $id_organizador,
            ':categoria' => $categoria
        ]);

        // Obter o último ID inserido
        $lastId = $this->lastInsertId();

        // Reativar as restrições de chave estrangeira
        $this->db->exec('SET FOREIGN_KEY_CHECKS=1;');

        return $lastId; // Retorna o último ID inserido
    }

    public function insertDataHora($id, $dataInicio, $horaInicio, $dataFim, $horaFim): bool{

        $sql = 'INSERT INTO data_hora (id, data_inicio, data_encerramento, hora_abertura, hora_encerramento) VALUES (:id, :data_inicio, :data_fim, :hora_inicio, :hora_fim);';
        
        // Executar a inserção na tabela de data_hora
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':data_inicio' => $dataInicio,
            ':data_fim' => $dataFim,
            ':hora_inicio' => $horaInicio,
            ':hora_fim' => $horaFim,
        ]);

    }

    public function updateEvent($id): bool{

        $this->db->exec('SET FOREIGN_KEY_CHECKS=0;');

        $sql = 'UPDATE eventos SET id_days = :id WHERE id = :id';

        $stmt = $this->db->prepare($sql);

        $this->db->exec('SET FOREIGN_KEY_CHECKS=1;');

        return $stmt->execute([
            ':id' => $id
        ]);

    }

    public function lastInsertId() {
        // Supondo que você esteja usando PDO para interagir com o banco de dados
        return $this->db->lastInsertId(); // Certifique-se de que $this->db é uma instância do PDO
    }

}

?>