<?php
session_start();
require_once './app/models/DashboardModel.php';
require_once './app/models/UserModel.php';

class dashboardController {

    public function index() {
        // Verificar se o usuário está autenticado
        if (!isset($_SESSION['email'])) {
            header('Location: /'); // Redireciona para a página de login se não estiver autenticado
            exit;
        }

        // Acessa o nome do usuário armazenado na sessão
        $nomeUtilizador = $_SESSION['nome'];
        $id = $_SESSION['id'];

        $userModel = new User();
        $userData = $userModel->getUser($_SESSION['id']); // Método para pegar os dados do utilizador


        if($userData){
                
            $_SESSION['role_id'] = (int)$userData['role_id'];

        }

        // Instancia o modelo Dashboard e busca os eventos
        $dashboardModel = new Dashboard();
        $eventos = $dashboardModel->getEventos(); // Obtém os eventos da base de dados

        // Envia os dados para a visão
        require_once './app/views/dashboard.php';
    }
}
?>
