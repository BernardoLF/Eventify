<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style_registo_login.css">
    <title>Registo</title>
</head>
<body>
    <h2>Registar-se</h2>
    <form action="/register" method="POST">
        <div>
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Registrar</button>
    </form>
    <p>Já tem uma conta? <a href="/login">Faça login aqui</a></p>
</body>
</html>
