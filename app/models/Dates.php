<?php

class Dates
{
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
}