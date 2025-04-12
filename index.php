<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Bem-vindo à Lista de Tarefas</h1>

        <!-- Feedback de status -->
        <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'task_added') {
                echo '<p>Tarefa adicionada com sucesso!</p>';
            } elseif ($status == 'task_removed') {
                echo '<p>Tarefa removida com sucesso!</p>';
            } elseif ($status == 'task_empty') {
                echo '<p>Erro: A tarefa não pode ser vazia.</p>';
            }
        }
        ?>

        <form action="tasks.php" method="POST" class="task-form">
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
                            <a href="tasks.php?remove=<?php echo $index; ?>" class="remove-task">❌</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
