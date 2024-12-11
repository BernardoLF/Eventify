<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style_registo_login.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="/dashboard" method="POST">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="emailUser" required>
        </div>
        <div>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="passwordUser" required>
        </div>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="/register">Registre-se aqui</a></p>
</body>
</html>
