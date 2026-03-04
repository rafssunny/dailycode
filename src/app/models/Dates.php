<?php

namespace Rafa\Dailycode\models;

use PDO;

class Dates
{
    public function getAllValues(PDO $connection): array
    {
        $query = $connection->query('SELECT * FROM dates ORDER BY date DESC;');
        $query_array = $query->fetchAll();
        $query_array;
        return $query_array;
    }
    public function findDateValues(string $input, PDO $connection): array
    {
        $query = $connection->prepare('SELECT * FROM dates 
    INNER JOIN codes ON dates.code_id = codes.id
    WHERE dates.date = ?');

        $query->execute([$input]);
        return $query->fetchAll();
    }
    public function addTodayDate(PDO $connection, array $code_data, string $today_date): void
    {
        $code_id = $code_data['id'];

        $query = $connection->prepare('INSERT IGNORE INTO dates (code_id, date) VALUES (?, ?)');
        $query->execute([$code_id, $today_date]);
    }
    public function getAvailableDates(array $values): array
    {
        $available_dates = [];
        foreach ($values as $date) {
            array_push($available_dates, $date);
        }
        $available_dates = array_column($available_dates, 'date');
        rsort($available_dates);
        return $available_dates;
    }
}
