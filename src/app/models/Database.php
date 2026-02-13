<?php
namespace Rafa\Dailycode\models;

use PDO;
use PDOException;

class Database
{
    const USER = USER;
    const PASSWORD = PASSWORD;
    const DATABASE = DATABASE;
    const HOST = HOST;

    public function connectDataBase(): PDO
    {
        try {
            return new PDO(
                "mysql:host=" . HOST . ";dbname=" . DATABASE,
                USER,
                PASSWORD
            );
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage() . '</br>/';
            die();
        }
    }

}
