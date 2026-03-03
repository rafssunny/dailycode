<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['username'], $_POST['password']) &&
        $_POST['username'] === 'admin' &&
        $_POST['password'] === '123'
    ) {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $js_warning = 'false';
    }
}

require_once __DIR__ . '/../src/app/views/login.php';