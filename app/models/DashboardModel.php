<?php

require_once './app/database/connection.php';

class Dashboard {

    private $db;

    public function __construct(){
        $this->db = Connection::getInstance();
    }

    


}

?>