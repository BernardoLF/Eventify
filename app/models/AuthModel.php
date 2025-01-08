<?php

require_once './app/database/connection.php';

class Auth{

    private $db;

    public function __construct(){
        // Inicializa a conexão com o banco de dados
        $this->db = Connection::getInstance();
    }

    public function insertUser($nome, $email, $password): bool{
        // Criptografa a senha do usuário
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL para inserir um novo usuário
        $sql = "INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)";

        // Prepara a consulta
        $stmt = $this->db->prepare(query: $sql);

        // Executa a consulta com os parâmetros fornecidos
        return $stmt->execute(params: [
            ':nome' => $nome,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    public function verificarLogin($email, $password): ?array {    
        // SQL para selecionar um usuário pelo email
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return null; // Usuário não encontrado
        }
        
        // Verificação explícita da senha
        $senhaCorreta = password_verify($password, $user['password']);
        if (!$senhaCorreta) {
            return null; // Senha incorreta
        }

        // Retorna o nome e status de autenticação
        return ['nome' => $user['nome'], 'id' => $user['id'], 'autenticado' => true];
    }

    public function getRole($roleId)
    {
        // SQL para selecionar o nome da função pelo ID
        $sql = "SELECT nome FROM roles WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$roleId]);
        $role = $stmt->fetch();
        return $role['nome']; // Retorna o nome da função
    }
}