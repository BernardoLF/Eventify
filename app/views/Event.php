<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
    <link rel="stylesheet" href="../css/event.css">
</head>
<body>
    <button class="btn-back" onclick="history.back()">Back</button>

    <div class="container">
        <div class="lado-esquerdo">
            <h1><?php echo $evento['titulo']; ?></h1>
            <img class="imagem" src='../images/<?= htmlspecialchars($evento['imagem']); ?>'>
        </div>

        <div class="lado-direito">
            <p><strong>Descrição:</strong> <?php echo $evento['descricao']; ?></p>
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