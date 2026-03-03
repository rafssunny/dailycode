<?php
namespace Rafa\Dailycode\controllers;

use Rafa\Dailycode\models\Codes;

class AdminController
{
    private Codes $codes;
    private int $rate_limit = 3;

    public function index()
    {
        if (!isset($_SESSION['rate'])) {
            $_SESSION['rate'] = 0;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_SESSION['rate'] > $this->rate_limit) {
                $js_warning = 'rate_limit';
            } else {
                if (
                    isset($_POST['username'], $_POST['password']) &&
                    $_POST['username'] === 'admin' &&
                    $_POST['password'] === '123'
                ) {
                    $_SESSION['admin'] = true;
                    header('Location: dashboard');
                    exit;
                } else {
                    $js_warning = 'incorrect';
                    $_SESSION['rate']++;
                }
            }
        }

        require_once __DIR__ . '/../views/login.php';
    }

    public function dashboard()
    {
        if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
            header('Location: login');
            exit;
        }

        require_once __DIR__ . '/../views/dashboard.php';
    }
}