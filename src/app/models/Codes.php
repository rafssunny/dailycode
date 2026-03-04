<?php
namespace Rafa\Dailycode\models;

use PDO;

class Codes
{
    public function getAllValues(PDO $connection): array
    {
        $query = $connection->query('SELECT * FROM codes ORDER BY date DESC;');
        $query_array = $query->fetchAll();
        $query_array;
        return $query_array;
    }
    public function getValues(PDO $connection): array
    {
        $query = $connection->query('SELECT * FROM dates 
        INNER JOIN codes ON dates.code_id = codes.id;');
        $query_array = $query->fetchAll();
        rsort($query_array);
        return $query_array;
    }
    public function getValuesOfSelectedDate(string $input, array $available_dates, object $dates, PDO $connection): array
    {
        if (in_array($input, $available_dates)) {
            return $dates->findDateValues($input, $connection);
        }
        return $dates->findDateValues($available_dates[0], $connection);
    }
    public function checkTodayDateIsInDates(PDO $connection, object $dates, Statistics $statistics): void
    {
        $today_date = date('Y-m-d');
        $stmt = $connection->prepare('SELECT * FROM dates WHERE date = ?');
        $stmt->execute([$today_date]);
        $check_date = $stmt->fetch();

        if (empty($check_date)) {
            $stmt = $connection->prepare('SELECT * FROM codes WHERE date = ?');
            $stmt->execute([$today_date]);
            $code_data = $stmt->fetch();
            if (!empty($code_data)) {
                $dates->addTodayDate($connection, $code_data, $today_date);
                $statistics->resetStatistics($connection);
            }
        }
    }

    public function checkUserOutput($output, $user_output): string
    {
        return match ($user_output) {
            $output => 'Correct',
            '' => '',
            default => 'Incorrect',
        };
    }
}