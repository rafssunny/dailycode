<?php


class Codes
{
    public function checkTodayDateIsInDates(PDO $connection): void
    {
        $today_date = date('Y-m-d');
        $stmt = $connection->prepare('SELECT * FROM codes WHERE date = ?');
        $stmt->execute([$today_date]);
        $code_data = $stmt->fetch();

        if (!empty($code_data)) {
            addTodayDate($connection, $code_data, $today_date);
        }
    }
    
}