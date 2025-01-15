<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/style_registo_login.css">
    <title>Registo</title>
</head>
<body>
    <h2>Registar-se</h2>
    <form method="POST">
        <div>
            <label>Nome Completo:</label>
            <input type="text" id="nome" name="nome" placeholder="Introduza o seu nome" value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" id="email" name="email" placeholder="Introzuda o seu email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        </div>
        <div>
            <label>Senha:</label>
            <input type="password" id="password" name="password" placeholder="Introduza uma password" required>
        </div>
        <?php if(isset($error)): ?>
            <p style="color:red;font-size:14px"><?php echo $error; ?></p>
        <?php endif; ?>
        <button type="submit">Registrar</button>
    </form>
    <p>Já tem uma conta? <a href="/">Faça login aqui</a></p>
</body>
</html>
