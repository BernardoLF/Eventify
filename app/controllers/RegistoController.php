<?php
session_start(); // Inicia a sessão

require_once './app/models/RegistoHistoricoModel.php'; // Inclui o modelo de usuário

class RegistoController{

    public function RegistoHistorico(){

        if (!isset($_SESSION['email'])) {
            header('Location: /'); // Redireciona para a página de login se não estiver autenticado
            exit;
        }

        $registo = new Registo;

        if(isset($_SESSION['role_id']) === 2){
            $utilizadores = $registo->getAllRegistoById(id: $_SESSION['role_id']);
        } else {
            $utilizadores = $registo->getAllRegistos();
        }

        require_once './app/views/registo.php';

    } 

}
?>