<?php
//Inicia a sessão
session_start();

require_once './app/models/EventModel.php';

class EventController {

    public function Event($id) {

        // Verifica se o usuário está autenticado
        if (!isset($_SESSION['email'])) {
            header('Location: /'); // Redireciona para a página de login se não estiver autenticado
            exit;
        }

        if($id){
            $eventModel = new Event();
            $evento = $eventModel->getEvent(id: $id); // Obtém os detalhes do evento

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Processa a compra de bilhetes
                $quantidade = $_POST['quantidade'];
                $titulo = $evento['titulo'];
                $email = $_SESSION['email'];

                if ($quantidade <= 0){
                    echo 'Quantidade deve ser 1 ou mais bilhetes'; // Mensagem de erro se a quantidade for inválida
                } else {
                    $resultado = $eventModel->bilhete(quantidade: $quantidade, id: $id); // Registra a compra

                    if($resultado){
                        // Mensagem de confirmação da compra
                        $corpoMensagem = <<<MSG
                            Compra dos bilhetes do evento $titulo
                            Comprou $quantidade bilhetes.

                            Os bilhetes dão para todos os dias em que o evento decorre.

                            Obrigado por comprar os bilhetes 
                            
                            Boas festas!
                        MSG;

                        $from = "testMail@testMail.eu";
                        $to = "$email";
                        $subject = "Confirmação da Venda de bilhetes - Eventify";
                        $message = $corpoMensagem;   
                        $headers = "From:" . $from;

                        mail($to,$subject,$message, $headers); // Envia o e-mail de confirmação

                        header('Location: ../dashboard'); // Redireciona para o dashboard após a compra
                    }
                }
            }
        
        } else {
            echo 'ID do evento não encontrado.'; // Mensagem de erro se o ID do evento não for encontrado
        }

        include './app/views/event.php'; // Carrega a view do evento
    }

    public function newEvent(){
        // Verifica se o usuário está autenticado
        if (!isset($_SESSION['email'])) {
            header('Location: /'); // Redireciona para a página de login se não estiver autenticado
            exit;
        } else if(!isset($_SESSION['role_id']) === 2){
            header('Location: /dashboard'); // Redireciona se o usuário não tiver a permissão adequada
        }
        
        // Verifica o User-Agent para bloquear dispositivos com largura de tela inferior a 640px
        if (preg_match('/Mobile|Android|iPhone|iPad|iPod/', $_SERVER['HTTP_USER_AGENT'])) {
            header('Location: /dashboard'); // Redireciona para o dashboard se o dispositivo for móvel
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Processa a criação de um novo evento
            $titulo = trim($_POST['titulo']);
            $capacidade = $_POST['capacidade'];
            $dataInicio = $_POST['dataInicio'];
            $dataFim = $_POST['dataFim'];
            $horaInicio = $_POST['horaInicio'];
            $horaFim = $_POST['horaFim'];
            $localizacao = trim($_POST['localizacao']);
            $descricao = trim($_POST['descricao']);
            $categoria = $_POST['categoria'];
            
            // Verifica se o arquivo foi enviado e se a chave 'imagem existe'
            if (isset($_FILES['imagem'])) {
                $arquivo = $_FILES['imagem'];
                $arquivoNovo = explode('.', $arquivo['name']);
                
                $extensaoPermitida = ['jpg', 'jpeg', 'png'];

                if (!in_array(strtolower($arquivoNovo[sizeof($arquivoNovo) - 1]), $extensaoPermitida)) {
                    die("Você não pode fazer upload deste arquivo"); // Mensagem de erro se a extensão não for permitida
                    require_once './app/views/newEvent.php';
                } else {
                    move_uploaded_file($arquivo['tmp_name'], 'images/' . $arquivo['name']); // Move o arquivo para o diretório de imagens
                    $nome_imagem = $arquivo['name'];

                    try {
                        // Verifica se a classe EventModel foi carregada corretamente
                        if (!class_exists('Event')) {
                            die("Erro: Classe Event não encontrada.");
                        }

                        $eventModel = new Event();
                        $resultado = $eventModel->insertEvent(titulo: $titulo, capacidade: $capacidade, localizacao: $localizacao, descricao: $descricao, nome_imagem: $nome_imagem, categoria: $categoria, id_organizador: $_SESSION['id']);
                        
                        if ($resultado) {
                            // Insere a data e hora do evento
                            try {
                                $resultado_hora = $eventModel->insertDataHora(id: $resultado, dataInicio: $dataInicio, dataFim: $dataFim, horaInicio: $horaInicio, horaFim: $horaFim);

                                if($resultado_hora === true){
                                    // Mensagem de depuração
                                    var_dump("Data e hora inseridas com sucesso.");

                                    try {
                                        $resultado_update = $eventModel->updateEvent(id: $resultado);

                                        if($resultado_update === true){
                                            session_start();
                                            $_SESSION['success_message'] = "Evento criado com sucesso!"; // Mensagem de sucesso
                                            header('Location: /dashboard'); // Redireciona para o dashboard
                                            exit;
                                        }

                                    } catch (Exception $e) {
                                        // Tratar erro específico da inserção de data e hora
                                        var_dump("Ocorreu um erro ao atualizar." . $e->getMessage());
                                        require_once './app/views/newEvent.php';
                                        return;
                                    }

                                }

                            } catch (Exception $e) {
                                // Tratar erro específico da inserção de data e hora
                                var_dump("Ocorreu um erro ao inserir a data e hora." . $e->getMessage());
                                require_once './app/views/newEvent.php';
                                return;
                            }
                            
                        } 

                    } catch (Exception $e) {
                        var_dump("Ocorreu um erro ao criar o evento: " . $e->getMessage());
                        require_once './app/views/newEvent.php';
                        return;
                    }
                }
            } else {
                require_once './app/views/newEvent.php';
                die("Nenhum arquivo foi enviado."); // Mensagem de erro se nenhum arquivo foi enviado
            }

        } else {
            require_once './app/views/newEvent.php'; // Carrega a view para criar um novo evento
        }
    }
}

?>