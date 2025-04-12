<?php
session_start();

// Adiciona tarefa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $_SESSION['tasks'][] = $task;
        header('Location: index.php?status=task_added');
        exit;
    } else {
        header('Location: index.php?status=task_empty');
        exit;
    }
}

// Remove tarefa
if (isset($_GET['remove'])) {
    $index = (int)$_GET['remove'];
    if (isset($_SESSION['tasks'][$index])) {
        unset($_SESSION['tasks'][$index]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindexa o array
        header('Location: index.php?status=task_removed');
        exit;
    }
}

// Redireciona para a página principal se nada for feito
header('Location: index.php');
exit;
