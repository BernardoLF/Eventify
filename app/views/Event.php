<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
    <link rel="stylesheet" href="../css/event.css">
</head>
<body>
<header>
        <nav>
                
            <ul class="menu">
                <?php if ($_SESSION['role_id'] === 3): ?>
                    <!-- Menu para Admin -->
                    <li><a href="../dashboard">Eventos</a></li>
                    <li><a href="../newEvent">Novo Evento</a></li>
                    <li><a href="../utilizadores">Utilizadores</a></li>
                    <li><a href="../historico">Registo Historico</a></li>
                    <li><a href="../logout">Sair</a></li>
                <?php elseif ($_SESSION['role_id'] === 1): ?>
                    <!-- Menu para Organizador -->
                    <li><a href="../dashboard">Eventos</a></li>
                    <li><a href="../newEvent">Novo Evento</a></li>
                    <li><a href="../historico">Registo Historico</a></li>
                    <li><a href="../logout">Sair</a></li>
                <?php else: ?>
                    <!-- Menu para Utilizadores -->
                    <li><a href="../dashboard">Eventos</a></li>
                    <li><a href="../historico">Registo Historico</a></li>
                    <li><a href="../logout">Sair</a></li>
                <?php endif; ?>
            </ul>
        </nav>  

        <h4>Olá, <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Utilizador'); ?>!</h1>
    </header>

    <div class="container">
        <div class="lado-esquerdo">
            <h1><?php echo $evento['titulo']; ?></h1>
            <img class="imagem" src='../images/<?= htmlspecialchars($evento['imagem']); ?>'>
        </div>

        <div class="lado-direito">
            <p class="descricao"><strong>Descrição:</strong> <?php echo $evento['descricao']; ?></p>
            <p><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($evento['data_inicio'])); ?> - <?php echo date('d/m/Y', strtotime($evento['data_encerramento']));?></p>
            <p><strong>Hora:</strong> <?php echo date('H:i', strtotime($evento['hora_abertura'])); ?> - <?php echo date('H:i', strtotime($evento['hora_encerramento'])); ?></p>
            <p><strong>Localização:</strong> <?php echo $evento['localizacao']; ?></p>
        
            <form method="POST">
                <div>
                <?php if ($evento['capacidade'] === 0): ?>
                    <span class="aviso">Bilhetes online do evento esgotado!</span>
                <?php else: ?>
                    <label><strong>Bilhetes:</strong></label>
                    <input type="number" name="quantidade" min=0 value=0>
                    <button type="submit">Comprar Bilhetes</button>
                <?php endif;?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>