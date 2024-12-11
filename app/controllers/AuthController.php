<?php

require_once './app/models/AuthModel.php';

class AuthController{

    public function register(): void{

        require_once './app/views/register.php';
    }

    public function login(): void{

        /* $nome = $_POST['nome'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $authModel = new Auth();
        $resultado = $authModel->insertUser(nome: $nome, email: $email, password: $pass); */

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['emailUser'];
            $password = $_POST['passwordUser'];
    
            $authModel = new Auth();
            $resultado = $authModel->getUser($email, $password);
    
            if (!isset($resultado['error'])) {
                // Login bem sucedido
                session_start();
                $_SESSION['user_id'] = $resultado['id'];
                $_SESSION['email'] = $resultado['email'];
                
                header('Location: /dashboard');
                exit;
            } else {
                // Login falhou
                $error = $resultado['error'];
                require_once './app/views/login.php';
            }
        } else {
            require_once './app/views/login.php';
        }
    }

    public function store(): void{
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $authModel = new Auth();
            $resultado = $authModel->insertUser(nome: $nome, email: $email, password: $pass);
            
            // Adicionar redirecionamento após registro
            if (!isset($resultado['error'])) {
                header('Location: /');
                exit;
            } else {
                // Se houver erro, voltar para página de registro
                require_once './app/views/register.php';
            }
        }
    }

}