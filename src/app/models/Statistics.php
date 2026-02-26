<?php

namespace Rafa\Dailycode\models;
use PDO;
class Statistics
{
    public function updateStatistics(string $is_correct, PDO $connection)
    {
        if (!$_SESSION['today_hit']) {
            if ($is_correct == 'Correct') {
                $connection->query('UPDATE statistics SET hits = hits + 1');
                $_SESSION['today_hit'] = true;
            } else {
                $connection->query('UPDATE statistics SET attempts = attempts+1');
                $_SESSION['today_attempts']++;
            }
        }
    }
    public function getAttempts(PDO $connection): bool|object
    {
        $query = $connection->query('SELECT attempts FROM statistics;');
        return $query->fetchObject();
    }
    public function getHits(PDO $connection): bool|object
    {
        $query = $connection->query('SELECT hits FROM statistics');
        return $query->fetchObject() ?? (object)['attempts'=>0];
    }
    public function resetStatistics(PDO $connection)
    {
        session_destroy();
        $query = $connection->query('UPDATE statistics set attempts = 0, hits = 0;') ?? (object)['attempts'=>0];
    }
}