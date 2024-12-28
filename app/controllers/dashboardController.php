<?php
session_start();
require_once './app/models/DashboardModel.php';

class dashboardController {

    public function index() {
        // Verificar se o usuário está autenticado
        if (!isset($_SESSION['email'])) {
            header('Location: /'); // Redireciona para a página de login se não estiver autenticado
            exit;
        }

        // Acessa o nome do usuário armazenado na sessão
        $nomeUsuario = $_SESSION['nome'];

        // Instancia o modelo Dashboard e busca os eventos
        $dashboardModel = new Dashboard();
        $eventos = $dashboardModel->getEventos(); // Obtém os eventos da base de dados

        // Envia os dados para a visão
        require_once './app/views/dashboard.php';
    }
}
?>
