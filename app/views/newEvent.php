<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/new_event.css">
    <title>Document</title>
   
</head>

<body>

    <header>
        <nav>
            <ul>
                <?php if ($_SESSION['role_id'] === 3): ?>
                    <li><a href="dashboard">Eventos</a></li>
                    <li><a href="#">Novo Evento</a></li>
                    <li><a href="utilizadores">Utilizadores</a></li>
                <?php else: ?>
                    <li><a href="dashboard">Eventos</a></li>
                    <li><a href="#">Novo Evento</a></li>
                <?php endif; ?>
            </ul>
        </nav>  
    </header>

    <div class="body_div">
    <form method="post" enctype="multipart/form-data">
    <h1>Criar Evento</h1>

    <div>
        <div class="contents" style="margin-right: 25px;">
            <label for="titulo" >Título do Evento:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Introduza o nome do evento" style="width:25vh;" required>
        </div>
        <div class="contents">
            <label for="capacidade">Capacidade:</label>
            <input type="number" id="capacidade" name="capacidade" placeholder="Capacidade" style="width: 12vh"required>
        </div>
    </div>
        
    <div>
        <div class="contents margin">
            <label for="dataInicio">Data início do Evento:</label>
            <input type="date" id="dataInicio" class="data" name="dataInicio" required min="<?php echo date('Y-m-d') ?>" onkeydown="return false;">
        </div>

        <div class="contents">
            <label for="dataFim">Data Fim do Evento:</label>
            <input type="date" id="dataFim" class="data" name="dataFim" required min="<?php echo date('Y-m-d'); ?>" onkeydown="return false;" oninput="this.setAttribute('min', document.getElementById('dataInicio').value);">
        </div>
    </div>
 
    <div>
        <div class="contents margin">
            <label for="hora">Hora Abertura:</label>
            <input type="time" id="hora" class="hora" name="horaInicio" step="60" required>
        </div>

        <div class="contents">
            <label for="hora">Hora Encerramento:</label>
            <input type="time" id="hora" class="hora" name="horaFim" step="60" required>
        </div>
    </div>
        
    
    <label for="localizacao" >Morada do Evento:</label>
    <input type="text" id="localizacao" name="localizacao" placeholder="Introduza a morada" style="margin-bottom:20px; width:40vh" required>
     
    <label for="descricao">Descrição do Evento:</label>
    <textarea id="descricao" name="descricao" style="width: 403px; height: 52px; resize: none; overflow: hidden; margin-bottom:20px" maxlength="215" placeholder="Introduza a descrição do evento"required></textarea>
   
    <label for="imagem">Imagem do Evento:</label>
    <input type="file" id="imagem" name="imagem" required>    
    
    <button type="submit" name="acao">Criar Evento</button>
    </form>
    </div>
        <script>
            document.getElementById('dataInicio').addEventListener('change', function() {
            document.getElementById('dataFim').setAttribute('min', this.value);
        });
    </script>

</body>
</html>