<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style_registo_login.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <div>
            <label>Email:</label>
            <input type="email" id="email" name="email" placeholder="Introduza o seu email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" id="password" name="password" placeholder="Introduza a seu password" required>
        </div>
        <?php if(isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="/register">Registre-se aqui</a></p>
</body>
</html>
