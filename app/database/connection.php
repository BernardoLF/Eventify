<?php

class Connection{

    private static $instance = null;

    public static function getInstance(){
        if (self::$instance == null){
            try{
                self::$instance = new PDO(
                    dsn: 'mysql:host=localhost; dbname=controlo_eventos',
                    username: 'root',
                    password: 'ShadowKnight1305+',
                    options: [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e){
                die("Erro conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

?>