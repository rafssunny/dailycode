<?php
ini_set('session.gc_maxlifetime', 86400);
session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config/config.php";

use Rafa\Dailycode\controllers\CodeController;

$controller = new CodeController();
$controller->index();

