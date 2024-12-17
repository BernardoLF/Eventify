<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    
    <h1>Olá, <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Utilizador'); ?>!</h1>

    <h2>Lista de Eventos</h2>

    <?php if (!empty($eventos)): ?>
        <!-- Container para os eventos -->
        <div class="eventos-container">
            <?php foreach ($eventos as $evento): ?>
                <div class="evento">
                    <h3><?= htmlspecialchars($evento['nome']); ?></h3>
                    <p class="data"><?= htmlspecialchars($evento['data']); ?></p>
                    <p><?= htmlspecialchars($evento['descricao']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Não há eventos cadastrados no momento.</p>
    <?php endif; ?>

</body>
</html>
