<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../config/config.php";

use Rafa\Dailycode\controllers\AdminController;
$lifetime = 1800;
session_set_cookie_params($lifetime);
session_start();

$admin_controller = new AdminController();

$path = $_GET['path'] ?? '';

if ($path == 'dashboard') {
    $admin_controller->dashboard();
} else {
    $admin_controller->index();
}