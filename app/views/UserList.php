<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/user_list.css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="dashboard">Eventos</a></li>
                <li><a href="newEvent">Novo Evento</a></li>
                <li><a href="#">Utilizadores</a></li>
                <li><a href="historico">Registo Historico</a></li>
                <li><a href="logout">Sair</a></li>
            </ul>
        </nav>  

        <h4>Olá, <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Utilizador'); ?>!</h1>
    </header>

<div class="user-list">
    <h2>Lista de Utilizadores</h2>
    <div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilizadores as $utilizador): ?>
                <tr>
                    <td><?php echo htmlspecialchars($utilizador['nome']); ?></td>
                    <td><?php echo htmlspecialchars($utilizador['email']); ?></td>
                    <td>
                        <span id="roleDisplay-<?php echo $utilizador['id']; ?>">
                            <?php echo htmlspecialchars($utilizador['role']); ?> 
                        </span>
                        <a href="#" onclick="toggleRoleForm(<?php echo $utilizador['id']; ?>)">
                            <img src="./icon/reescrever.png" alt="Reescrever">
                        </a>
                        <div id="roleForm-<?php echo $utilizador['id']; ?>" style="display:none;">
                            <form method="POST" onsubmit="return updateRoleDisplay(<?php echo $utilizador['id']; ?>)">
                                <input type="hidden" name="id" value="<?php echo $utilizador['id']; ?>">
                                <select name="newRole">
                                    <?php if ($utilizador['role_id'] == '3'): ?>
                                        <option value="2">participante</option>
                                        <option value="1">organizador</option>
                                    <?php elseif ($utilizador['role_id'] == '1'): ?>
                                        <option value="2">participante</option>
                                        <option value="3">admin</option>
                                    <?php else: ?>
                                        <option value="1">organizador</option>
                                        <option value="3">admin</option>
                                    <?php endif; ?>
                                </select>
                                <button type="submit">Mudar Função</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<script>
function toggleRoleForm(userId) {
    var form = document.getElementById('roleForm-' + userId);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
</body>
</html>