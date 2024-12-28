<?php
session_start();

class UserListController{

    public function users(){

        require_once './app/views/UserList.php';

    }

}

?>