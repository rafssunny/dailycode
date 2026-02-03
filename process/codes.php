<?php
include_once ('../config/config.php');

$query = $connection->query('SELECT * FROM dates 
INNER JOIN codes ON dates.id = codes.id;');
$query_array = $query->fetchAll();

function findDateValues($input, $connection): array{
    $query = $connection->prepare('SELECT * FROM dates 
    INNER JOIN codes ON dates.id = codes.id
    WHERE dates.date = ?');

    $query->execute([$input]);
    $query_array = $query->fetchAll();
    return $query_array;
}
?>