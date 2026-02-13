<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../src/app/views/index.php";

use Rafa\Dailycode\CodeController\CodeController;

$controller = new CodeController();
$controller->index();
