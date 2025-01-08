<?php
// Inicia a sessão
session_start();

require_once './app/models/AuthModel.php';

class AuthController{

    public function register(): void{

        // Verifica se o usuário já está autenticado
        if (isset($_SESSION['email'])) {
            header('Location: /dashboard'); // Redireciona para a página de login se não estiver autenticado
            exit;
        }

        // Verifica se o método de requisição é POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Captura e sanitiza os dados do formulário
            $nome = trim($_POST['nome']);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $pass = trim($_POST['password']);

            // Validação dos campos
            $errors = [];

            // Validar nome
            if (empty($nome)) {
                $errors[] = "O nome é obrigatório";
            } elseif (strlen($nome) < 3) {
                $errors[] = "O nome deve ter pelo menos 3 caracteres";
            }

            // Validar email
            if (empty($email)) {
                $errors[] = "O email é obrigatório";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Por favor, insira um email válido";
            }

            // Critérios de validação da senha
            $requisitos = [
                'especial' => preg_match('/[!@#$%^&*(),.?":{}|<>+]/', $pass),
                'numero' => preg_match('/[0-9]/', $pass),
                'maiuscula' => preg_match('/[A-Z]/', $pass),
                'minuscula' => preg_match('/[a-z]/', $pass),
                'comprimento' => strlen($pass) >= 8
            ];

            // Verifica se há algum requisito não atendido
            $requisitosNaoAtendidos = array_filter($requisitos, function($requisito) {
                return !$requisito;
            });

            // Só adiciona a mensagem de cabeçalho se houver requisitos não atendidos
            if (!empty($requisitosNaoAtendidos)) {
                $errors[] = "A senha deve conter:";
                
                // Adiciona mensagens de erro para requisitos não atendidos
                if (!$requisitos['especial']) {
                    $errors[] = "- Pelo menos um caractere especial";
                }
                if (!$requisitos['numero']) {
                    $errors[] = "- Pelo menos um número";
                }
                if (!$requisitos['maiuscula']) {
                    $errors[] = "- Pelo menos uma letra maiúscula";
                }
                if (!$requisitos['minuscula']) {
                    $errors[] = "- Pelo menos uma letra minúscula"; 
                }
                if (!$requisitos['comprimento']) {
                    $errors[] = "- No mínimo 8 caracteres";
                }
            }

            // Se houver erros, exibe-os
            if (!empty($errors)) {
                $error = implode("<br>", $errors);
                require_once './app/views/register.php';
                return;
            }

            // Tenta inserir o usuário no banco de dados
            try {
                $authModel = new Auth();
                $resultado = $authModel->insertUser(nome: $nome, email: $email, password: $pass);
                
                // Verifica se a inserção foi bem-sucedida
                if ($resultado === true) {
                    session_start();
                    $_SESSION['success_message'] = "Conta criada com sucesso! Faça login para continuar.";
                    header('Location: /');
                    exit;
                }
            } catch (Exception $e) {
                // Captura erros durante a inserção
                $error = "Ocorreu um erro ao criar a conta. Por favor, tente novamente.";
                require_once './app/views/register.php';
                return;
            }
 
        } else {
            // Se não for uma requisição POST, exibe o formulário de registro
            require_once './app/views/register.php';
        }
    }

    public function login(): void{

        // Verifica se o usuário já está autenticado
        if (isset($_SESSION['email'])) {
            header('Location: /dashboard'); // Redireciona para a página de login se não estiver autenticado
            exit;
        }

        // Verifica se o método de requisição é POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados do formulário
            $password = $_POST['password'];
            $email = $_POST['email'];

            // Verifica as credenciais do usuário
            $authModel = new Auth();
            $loginSucesso = $authModel->verificarLogin($email, $password);

            // Se o login for bem-sucedido
            if ($loginSucesso) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $loginSucesso['nome'];
                $_SESSION['id'] = (int)$loginSucesso['id'];
                
                header('Location: /dashboard');
                exit;
            } else {
                // Se o login falhar
                $error = "Email ou senha incorretos";
                require_once './app/views/login.php';
            }
        } else {
            // Se não for uma requisição POST, exibe o formulário de login
            require_once './app/views/login.php';
        }
    }
}