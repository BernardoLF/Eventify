<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify</title>
    <link rel="stylesheet" href="./css/style_dashboard.css">
</head>
<body>
    
    <header>
        <nav>
            <ul>
                <?php if ($_SESSION['role_id'] === 3): ?>
                    <li><a href="#">Eventos</a></li>
                    <li><a href="newEvent">Novo Evento</a></li>
                    <li><a href="utilizadores">Utilizadores</a></li>
                <?php elseif ($_SESSION['role_id'] === 1): ?>
                    <li><a href="#">Eventos</a></li>
                    <li><a href="newEvent">Novo Evento</a></li>
                <?php else: ?>
                    <li><a href="#">Eventos</a></li>
                <?php endif; ?>
            </ul>
        </nav>  

        <h4>Olá, <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Utilizador'); ?>!</h1>
    </header>

    <h2>Lista de Eventos</h2>

    <?php if (!empty($eventos)): ?>
        <!-- Container para os eventos -->
        <div class="eventos-container">
            <?php foreach ($eventos as $evento): ?>

                <?php 
                // Combina data_encerramento e hora_encerramento para a verificação de inatividade
                $eventoInativo = (strtotime($evento['data_encerramento'] . ' ' . $evento['hora_encerramento']) < time()) ? 'evento inativo' : 'evento'; 
                ?>
                
                <a href='event?id=<?= htmlspecialchars($evento['id']); ?>' class="<?= $eventoInativo; ?>">
                <div>
                    <h3><?= htmlspecialchars($evento['titulo']); ?></h3>
                    <img class="imagem" src='./images/<?= htmlspecialchars($evento['imagem']); ?>'>
                    <p class="data">
                        <?php 
                            $dataInicio = new DateTime($evento['data_inicio']);
                            $dataEncerramento = new DateTime($evento['data_encerramento']);
                        ?>
                        <?= htmlspecialchars($dataInicio->format('d/m/Y')); ?> - <?= htmlspecialchars($dataEncerramento->format('d/m/Y')); ?>
                    </p>
                    <p><?= htmlspecialchars($evento['descricao']); ?></p>
                </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Não há eventos cadastrados no momento.</p>
    <?php endif; ?>

</body>
</html>
