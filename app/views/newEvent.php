<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="/dashboard">
    <h1>Criar Evento</h1>

    <label for="titulo">Título do Evento:</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="data">Data do Evento:</label>
    <input type="date" id="data" name="data" required>

    <label for="hora">Hora do Evento:</label>
    <input type="time" id="hora" name="hora" required>

    <label for="descricao">Descrição do Evento:</label>
    <textarea id="descricao" name="descricao" rows="5" required></textarea>

    <label for="imagem">Imagem do Evento:</label>
    <input type="file" id="imagem" name="imagem" accept="image/*" required>

    <button type="submit">Criar Evento</button>
    </form>
</body>
</html>