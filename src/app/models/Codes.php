<?php
namespace Rafa\Dailycode\models;

use PDO;

class Codes
{
    public function getValues(PDO $connection): array
    {
        $query = $connection->query('SELECT * FROM dates 
        INNER JOIN codes ON dates.code_id = codes.id;');
        $query_array = $query->fetchAll();
        rsort($query_array);
        return $query_array;
    }
    public function checkTodayDateIsInDates(PDO $connection, $dates): void
    {
        $today_date = date('Y-m-d');
        $stmt = $connection->prepare('SELECT * FROM codes WHERE date = ?');
        $stmt->execute([$today_date]);
        $code_data = $stmt->fetch();

        if (!empty($code_data)) {
            $dates->addTodayDate($connection, $code_data, $today_date);
        }
    }

}