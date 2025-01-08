<?php

class Connection{

    private static $instance = null; // Instância única da classe

    public static function getInstance(){
        // Verifica se a instância já foi criada

        if (self::$instance == null){ 
            try{

                // Cria uma nova conexão PDO
                self::$instance = new PDO(
                    dsn: 'mysql:host=localhost; dbname=controlo_eventos', // Fonte de dados
                    username: 'root', // Nome de usuário do banco de dados
                    password: 'root', // Senha do banco de dados
                    options: [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Modo de erro
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Modo de busca padrão
                    ]
                );
            } catch (PDOException $e){
                 // Captura e exibe erro de conexão
                die("Erro conexão: " . $e->getMessage());
            }
        }
        return self::$instance; // Retorna a instância da conexão
    }
}

?>