<?php
session_start();

// Adiciona tarefa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $_SESSION['tasks'][] = $task;
    }
}

// Remove tarefa
if (isset($_GET['remove'])) {
    $index = (int)$_GET['remove'];
    if (isset($_SESSION['tasks'][$index])) {
        unset($_SESSION['tasks'][$index]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindexa o array
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="style.css"> <!-- Aqui, assume-se que style.css está na mesma pasta -->
</head>
<body>
    <div class="container">
        <h1 class="title">Bem-vindo à Lista de Tarefas</h1>

        <!-- Formulário para adicionar tarefa -->
        <form action="index.php" method="POST" class="task-form">
            <input type="text" name="task" placeholder="Adicione uma nova tarefa..." required>
            <button type="submit">Adicionar Tarefa</button>
        </form>

        <div class="task-list">
            <h2>Minhas Tarefas</h2>
            <?php if(empty($_SESSION['tasks'])): ?>
                <p>Você ainda não tem tarefas.</p>
            <?php else: ?>
                <ul>
                    <?php foreach($_SESSION['tasks'] as $index => $task): ?>
                        <li>
                            <?php echo htmlspecialchars($task); ?>
                            <a href="index.php?remove=<?php echo $index; ?>" class="remove-task">❌</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
