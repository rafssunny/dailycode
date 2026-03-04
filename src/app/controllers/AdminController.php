<?php
namespace Rafa\Dailycode\controllers;

use Rafa\Dailycode\models\Codes;
use PDO;
use Rafa\Dailycode\models\Database;
use Rafa\Dailycode\models\Dates;
use Rafa\Dailycode\services\AdminService;
class AdminController
{
    private Codes $codes;
    private Dates $dates;
    private AdminService $admin_service;
    private PDO $connection;
    private int $rate_limit = 3;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connectDataBase();
        $this->codes = new Codes();
        $this->dates = new Dates();
        $this->admin_service = new AdminService();
    }
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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $js_warning = $this->admin_service->delete($this->connection);
        }
        
        $code_values = $this->codes->getAllValues($this->connection);
        $date_values = $this->dates->getAllValues($this->connection);
        $error = $this->admin_service->error;
        
        
        require_once __DIR__ . '/../views/dashboard.php';
    }
}