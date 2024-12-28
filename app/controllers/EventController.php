<?php
session_start();

require_once './app/models/EventModel.php';

class EventController{

    public function index(){

        require_once './app/views/Event.php';
    }

    public function newEvent(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titulo = trim($_POST['titulo']);
            $capacidade = $_POST['capacidade'];
            $dataInicio = $_POST['dataInicio'];
            $dataFim = $_POST['dataFim'];
            $horaInicio = $_POST['horaInicio'];
            $horaFim = $_POST['horaFim'];
            $localizacao = trim($_POST['localizacao']);
            $descricao = trim($_POST['descricao']);
            
            // Verifica se o arquivo foi enviado
            if (isset($_FILES['imagem'])) { // Verifica se a chave 'imagem' existe
                $arquivo = $_FILES['imagem'];
                $arquivoNovo = explode('.', $arquivo['name']);
                
                $extensaoPermitida = ['jpg', 'jpeg', 'png'];

                if (!in_array(strtolower($arquivoNovo[sizeof($arquivoNovo) - 1]), $extensaoPermitida)) {
                    die("Você não pode fazer upload deste arquivo");
                    require_once './app/views/newEvent.php';

                } else {
                    move_uploaded_file($arquivo['tmp_name'], 'images/' . $arquivo['name']);
                    $nome_imagem = $arquivo['name'];

                    
                    try {
                        // Verifica se a classe EventModel foi carregada corretamente
                        if (!class_exists('Event')) {
                            die("Erro: Classe Event não encontrada.");
                        }

                        $eventModel = new Event();
                        $resultado = $eventModel->insertEvent(titulo: $titulo, capacidade: $capacidade, localizacao: $localizacao, descricao: $descricao, nome_imagem: $nome_imagem);
                        
                        if ($resultado) {
                            
                            try {
                                $resultado_hora = $eventModel->insertDataHora(id: $resultado, dataInicio: $dataInicio, dataFim: $dataFim, horaInicio: $horaInicio, horaFim: $horaFim);

                                if($resultado_hora === true){
                                    // Adicionando mensagem de depuração
                                    var_dump("Data e hora inseridas com sucesso.");

                                    try {
                                        $resultado_update = $eventModel->updateEvent(id: $resultado);

                                        if($resultado_update === true){
                                            session_start();
                                            $_SESSION['success_message'] = "Evento criado com sucesso!";
                                            header('Location: /dashboard');
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
                die("Nenhum arquivo foi enviado.");
            }

        } else {
        
            require_once './app/views/newEvent.php';

        }
    }
}

?>