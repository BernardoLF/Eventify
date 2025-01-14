<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/historico.css">
    <title>Registo Historico</title>
</head>
<body>

    <header>
        <nav>
                
            <ul class="menu">
                <?php if ($_SESSION['role_id'] === 3): ?>
                    <!-- Menu para Admin -->
                    <li><a href="#">Eventos</a></li>
                    <li><a href="newEvent">Novo Evento</a></li>
                    <li><a href="utilizadores">Utilizadores</a></li>
                    <li><a href="historico">Registo Historico</a></li>
                    <li><a href="logout">Sair</a></li>
                <?php elseif ($_SESSION['role_id'] === 1): ?>
                    <!-- Menu para Organizador -->
                    <li><a href="#">Eventos</a></li>
                    <li><a href="newEvent">Novo Evento</a></li>
                    <li><a href="historico">Registo Historico</a></li>
                    <li><a href="logout">Sair</a></li>
                <?php else: ?>
                    <!-- Menu para Utilizadores -->
                    <li><a href="#">Eventos</a></li>
                    <li><a href="historico">Registo Historico</a></li>
                    <li><a href="logout">Sair</a></li>
                <?php endif; ?>
            </ul>
        </nav>  

        <h4>Olá, <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Utilizador'); ?>!</h1>
    </header>

<main>
    <h2>Registo Histórico</h2>
    <table>
        <thead>
            <tr>
                <th>Nome do Evento</th>
                <th>Nome do Utilizador</th>
                <th>Bilhete</th>
                <th>Hora do registo</th>
                <th>Data do registo</th>
            </tr>
        </thead>
        <tbody>
    <?php if (!empty($utilizadores)): ?>
        <?php foreach ($utilizadores as $registo): ?>
            <tr>
                <td><?php echo htmlspecialchars($registo['nome_evento']); ?></td>
                <td><?php echo htmlspecialchars($registo['nome_utilizador']); ?></td>
                <td><?php echo htmlspecialchars($registo['bilhetes']); ?></td>
                <td>
                    <?php 
                        // Extrai e formata a hora
                        echo isset($registo['data_hora']) 
                            ? date('H:i:s', strtotime($registo['data_hora'])) 
                            : 'N/A'; 
                    ?>
                </td>
                <td>
                    <?php 
                        // Extrai e formata a data
                        echo isset($registo['data_hora']) 
                            ? date('d/m/Y', strtotime($registo['data_hora'])) 
                            : 'N/A'; 
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Nenhum registo encontrado.</td>
        </tr>
    <?php endif; ?>
    </tbody>
    </table>
</main>

</body>
</html>