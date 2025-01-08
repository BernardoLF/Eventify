<?php
session_start(); // Inicia a sessão

require_once './app/models/UserModel.php'; // Inclui o modelo de usuário

class UtilizadoresController{

    public function users(){

        // Verifica se o usuário está autenticado
        if (!isset($_SESSION['email'])) {
            header('Location: /'); // Redireciona para a página de login se não estiver autenticado
            exit;
        } else if(!isset($_SESSION['role_id']) === 2 || !isset($_SESSION['role_id']) === 1){
            header('Location: /dashboard'); // Redireciona para o dashboard se o papel não for válido
        }

        $userModel = new User; // Cria uma nova instância do modelo de usuário
        $utilizadores = $userModel->getAllUsers(); // Obtém todos os usuários

        require_once './app/views/userList.php'; // Inclui a visualização da lista de usuários

        // Verifica se a requisição é do tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['id']; // Obtém o ID do usuário
            $newRoleId = $_POST['newRole']; // Obtém o novo ID do papel
    
            $userModel = new User; // Cria uma nova instância do modelo de usuário
            $resultado = $userModel->changeRole($userId, $newRoleId); // Altera o papel do usuário
    
            // Verifica se a alteração foi bem-sucedida
            if($resultado){
                echo '<script>window.location.href = "/utilizadores";</script>'; // Redireciona para a lista de usuários
                exit();
            }
        }

    }

}

?>