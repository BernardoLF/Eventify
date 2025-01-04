<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $evento['titulo']; ?></h1>
        <p><strong>Descrição:</strong> <?php echo $evento['descricao']; ?></p>
        <p><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($evento['data_inicio'])); ?> - <?php echo date('d/m/Y', strtotime($evento['data_encerramento']));?></p>
        <p><strong>Local:</strong> <?php echo $evento['localizacao']; ?></p>
        
        
        
        <a href="inscrever.php?id=<?php echo $evento['id']; ?>">Inscrever-se</a>
    </div>
</body>
</html>