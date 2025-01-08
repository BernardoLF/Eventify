<?php
session_start();

require_once './app/models/UserModel.php';

class UtilizadoresController{

    public function users(){

        if (!isset($_SESSION['email'])) {
            header('Location: /'); // Redireciona para a página de login se não estiver autenticado
            exit;
        } else if(!isset($_SESSION['role_id']) === 2 || !isset($_SESSION['role_id']) === 1){
            header('Location: /dashboard');
        }

        $userModel = new User;
        $utilizadores = $userModel->getAllUsers();

        require_once './app/views/userList.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['id'];
            $newRoleId = $_POST['newRole'];
    
            $userModel = new User;
            $resultado = $userModel->changeRole($userId, $newRoleId);
    
            if($resultado){
                echo '<script>window.location.href = "/utilizadores";</script>';
                exit();
            }
        }

    }

}

?>