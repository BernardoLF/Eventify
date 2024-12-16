<?php
session_start();

class dashboardController{

    public function index(){

        if (!isset($_SESSION['email'])) {
            header('Location: /login'); // Redireciona para a página de login se não estiver autenticado
            exit;
        }

        // Acessa o nome do usuário armazenado na sessão
        $nomeUsuario = $_SESSION['nome'];

        require_once './app/views/dashboard.php';
    }

}

?>