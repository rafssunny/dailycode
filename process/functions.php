<?php

include_once('../config/config.php');


// functions
function connectDataBase(): PDO
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

function findDateValues(string $input, PDO $connection): array
{
    $query = $connection->prepare('SELECT * FROM dates 
    INNER JOIN codes ON dates.code_id = codes.id
    WHERE dates.date = ?');

    $query->execute([$input]);
    return $query->fetchAll();
}

function checkTodayDateIsInDates(PDO $connection): void
{
    $today_date = date('Y-m-d');
    $stmt = $connection->prepare('SELECT * FROM codes WHERE date = ?');
    $stmt->execute([$today_date]);
    $code_data = $stmt->fetch();

    if (!empty($code_data)) {
        addTodayDate($connection, $code_data, $today_date);
    }
}

function addTodayDate(PDO $connection, array $code_data, string $today_date): void
{
    $code_id = $code_data['id'];

    $query = $connection->prepare('INSERT IGNORE INTO dates (code_id, date) VALUES (?, ?)');
    $query->execute([$code_id, $today_date]);
}
