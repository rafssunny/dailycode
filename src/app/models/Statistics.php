<?php

namespace Rafa\Dailycode\models;
use PDO;

class Statistics
{
    private int $attempts;
    private int $hits;
    private float $average;

    // i will modularize this, i just want to organize my thoughts
    public function process(PDO $connection, string $first_today_hit, int $js_attemps)
    {
        if($first_today_hit == 'false') {
            $this->attempts = $connection->query('SELECT attempts FROM statistics;');
            $this->attempts+=$js_attemps;
            $connection->query("INSERT INTO statistics (attempts) VALUES ($this->attempts);");
            $this->hits = $connection->query('SELECT hits FROM statistics;');
            $this->hits = $connection->query("INSERT INTO statistics ($this->hits++)");
        }
        $this->average = ($this->attempts/$this->hits) * 100;
    }
}