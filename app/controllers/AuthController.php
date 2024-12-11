<?php

require_once '../app/models/AuthModel.php';

class AuthController{

    public function register(): void{

        require_once '../app/views/register.php';
    }

    public function login(): void{

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $authModel = new Auth();
        $resultado = $authModel->insertUser(nome: $nome, email: $email, password: $pass);

        

        require_once '../app/views/login.php';
    }

    public function store(): void{
        
    }

}