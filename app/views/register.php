<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style_registo_login.css">
    <title>Registo</title>
</head>
<body>
    <h2>Registar-se</h2>
    <form action="/" method="POST">
        <div>
            <label>Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label>Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Registrar</button>
    </form>
    <p>Já tem uma conta? <a href="/">Faça login aqui</a></p>
</body>
</html>
