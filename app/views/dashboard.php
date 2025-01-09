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
                    <!-- Menu para Admin -->
                    <li><a href="#">Eventos</a></li>
                    <li><a href="newEvent">Novo Evento</a></li>
                    <li><a href="utilizadores">Utilizadores</a></li>
                <?php elseif ($_SESSION['role_id'] === 1): ?>
                    <!-- Menu para Organizador -->
                    <li><a href="#">Eventos</a></li>
                    <li><a href="newEvent">Novo Evento</a></li>
                <?php else: ?>
                    <!-- Menu para Utilizadores -->
                    <li><a href="#">Eventos</a></li>
                <?php endif; ?>
            </ul>
        </nav>  

        <h4>Olá, <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Utilizador'); ?>!</h1>
    </header>

    <h2>Lista de Eventos</h2>

    <?php if (!empty($eventos)): ?>
        <!-- Container para os eventos -->

        <label style="padding-left: 25px" for="preferencias">Preferências:</label>
        <select name="preferencias" id="preferencias">
            <option value="0">-- Todos os Evento</option>
            <option value="1">Educação e Carreira</option>
            <option value="2">Arte e Cultura</option>
            <option value="3">Desporto e Bem-estar</option>
            <option value="4">Tecnologia e Inovação</option>
            <option value="5">Empreendedorismo e Negócios</option>
            <option value="6">Entretenimento e Lazer</option>
            <option value="7">Comunidade e Solidariedade</option>
            <option value="8">Ciência e Meio Ambiente</option>
        </select>

        <div class="eventos-container">
            <?php foreach ($eventos as $evento): ?>

                <?php 
                // Combina data_encerramento e hora_encerramento para a verificação de inatividade
                $eventoInativo = (strtotime($evento['data_encerramento'] . ' ' . $evento['hora_encerramento']) < time()) ? 'evento inativo' : 'evento'; 
                ?>
                
                <a data-categoria="<?= htmlspecialchars($evento['id_categoria'])?>" href='event/<?= htmlspecialchars($evento['id']); ?>' class="<?= $eventoInativo; ?>">
                <div>
                    <h3><?= htmlspecialchars($evento['titulo']); ?></h3>
                    <img class="imagem" src='./images/<?= htmlspecialchars($evento['imagem']); ?>'>
                    <p class="data">
                        <?php 
                            // Formata as datas de início e encerramento
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

    <script>
        // Adiciona um listener para o evento de mudança no seletor de preferências
        document.getElementById('preferencias').addEventListener('change', function() {
            var selectedValue = this.value;
            var eventos = document.querySelectorAll('.eventos-container a');

            eventos.forEach(function(evento) {
                // Mostra ou oculta eventos com base na preferência selecionada
                if (selectedValue == 0 || evento.getAttribute('data-categoria') == selectedValue) {
                    evento.style.display = 'block'; // Mostra o evento
                } else {
                    evento.style.display = 'none'; // Oculta o evento
                }
            });
        });
    </script>

</body>
</html>