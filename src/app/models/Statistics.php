<?php

namespace Rafa\Dailycode\models;
use PDO;
class Statistics
{
    public function updateStatistics(string $is_correct, PDO $connection): void
    {
        if (!$_SESSION['today_hit']) {
            if ($is_correct == 'Correct') {
                $this->setHits($connection);
                $this->setAttempts($connection);
            } else {
                $this->setAttempts($connection);
            }
        }
    }
    public function getAttempts(PDO $connection): bool|object
    {
        $query = $connection->query('SELECT attempts FROM statistics;');
        return $query->fetchObject();
    }
    private function setAttempts(PDO $connection): void
    {
        $connection->query('UPDATE statistics SET attempts = attempts+1');
        $_SESSION['today_attempts']++;
    }
    public function getHits(PDO $connection): bool|object
    {
        $query = $connection->query('SELECT hits FROM statistics');
        return $query->fetchObject() ?? (object) ['attempts' => 0];
    }
    private function setHits(PDO $connection): void
    {
        $connection->query('UPDATE statistics SET hits = hits + 1');
        $_SESSION['today_hit'] = true;
    }
    public function resetStatistics(PDO $connection): void
    {
        session_destroy();
        $query = $connection->query('UPDATE statistics set attempts = 0, hits = 0;') ?? (object) ['attempts' => 0];
    }
}