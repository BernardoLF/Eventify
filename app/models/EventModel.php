<?php

require_once './app/database/connection.php';

class Event {

    private $db;

    public function __construct(){
        // Inicializa a conexão com o banco de dados
        $this->db = Connection::getInstance();
    }

    public function getEvent($id) {
        // SQL para buscar um evento específico pelo ID
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

        // Prepara a consulta SQL
        $stmt = $this->db->prepare($sql);
        // Executa a consulta com o ID do evento
        $stmt->execute([':id' => $id]);

        // Retorna os dados do evento como um array associativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bilhete($quantidade, $id){
        // Reduz a quantidade de bilhetes disponíveis para um evento
        $sql = "UPDATE eventos SET capacidade = capacidade - :quantidade WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        // Executa a atualização da capacidade
        return $stmt->execute([
            ':quantidade' => $quantidade,
            ':id' => $id
        ]);
    }

    public function insertEvent($titulo, $capacidade, $localizacao, $descricao, $id_days, $nome_imagem, $categoria, $id_organizador): bool{
        // SQL para inserir um novo evento
        $sql = 'INSERT INTO eventos (titulo, descricao, id_days, localizacao, capacidade, id_organizador, imagem, id_categoria) VALUES (:titulo, :descricao, :id_days, :localizacao, :capacidade, :id_organizador, :imagem, :categoria);';
        
        // Prepara a consulta SQL
        $stmt = $this->db->prepare($sql);
        // Executa a inserção do evento
         return $stmt->execute([
            ':id_days' => $id_days,
            ':titulo' => $titulo,
            ':capacidade' => $capacidade,
            ':localizacao' => $localizacao,
            ':descricao' => $descricao,
            ':imagem' => $nome_imagem,
            ':id_organizador' => $id_organizador,
            ':categoria' => $categoria
        ]);
    }

    public function insertDataHora($dataInicio, $horaInicio, $dataFim, $horaFim): int{
        // SQL para inserir dados de data e hora para um evento
        $sql = 'INSERT INTO data_hora (data_inicio, data_encerramento, hora_abertura, hora_encerramento) VALUES (:data_inicio, :data_fim, :hora_inicio, :hora_fim);';
        
        // Prepara a consulta SQL
        $stmt = $this->db->prepare($sql);
        // Executa a inserção dos dados de data e hora
        $stmt->execute([
            /* ':id' => $id, */
            ':data_inicio' => $dataInicio,
            ':data_fim' => $dataFim,
            ':hora_inicio' => $horaInicio,
            ':hora_fim' => $horaFim,
        ]);

        // Obtém o último ID inserido
        $lastId = $this->lastInsertId();

        return $lastId;
    }

    public function updateEvent($id): bool{
        // Desativa as restrições de chave estrangeira temporariamente
        $this->db->exec('SET FOREIGN_KEY_CHECKS=0;');

        // SQL para atualizar o ID do dia associado a um evento
        $sql = 'UPDATE eventos SET id_days = :id WHERE id = :id';

        // Prepara a consulta SQL
        $stmt = $this->db->prepare($sql);

        // Reativa as restrições de chave estrangeira
        $this->db->exec('SET FOREIGN_KEY_CHECKS=1;');

        // Executa a atualização do evento
        return $stmt->execute([':id' => $id]);
    }

    public function lastInsertId() {
        // Retorna o último ID inserido na tabela
        return $this->db->lastInsertId(); // Certifique-se de que $this->db é uma instância do PDO
    }
}

?>