<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $user;

    public function __construct($pdo)
    {
        $this->user = new User($pdo);
    }

    public function showLogin()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    public function showRegister()
    {
        require_once __DIR__ . '/../views/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->user->register($nome, $email, $password)) {
                header('Location: /login');
                exit();
            } else {
                echo "Erro ao registar.";
            }
        }
    }

    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->user->login($email, $password);

        if ($user) {
            session_start();

            $_SESSION['user'] = $user;

            $role = $this->user->getRole($user['role_id']);

            $_SESSION['role'] = $role;

            header('Location: /dashboard');
            exit();
        } else {
            echo "Credenciais inválidas.";
        }
    }
}

}