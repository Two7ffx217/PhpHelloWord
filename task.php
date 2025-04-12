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

header('Location: index.php'); // Redireciona de volta para a página principal
exit;
