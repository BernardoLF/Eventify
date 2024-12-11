<?php

require_once '../app/models/AuthModel.php';

class AuthController{
    
    private $user;

    public function register(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->user->register($nome, $email, $password)) {
                header('Location: /');
                exit();
            } else {
                echo "Erro ao registar.";
            }
        }

        require_once '../app/views/register.php';
    }

    public function login(){

        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->user->login($email, $password);

            if ($user) {
                session_start();

                $_SESSION['user'] = $user;

                $role = $this->user->getRole($user['role_id']);

                $_SESSION['role'] = $role;

            } else {
                echo "Credenciais inválidas.";
            }
        }

        require_once '../app/views/login.php';
    }

}