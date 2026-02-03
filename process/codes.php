<?php
include_once ('../config/config.php');

$query = $connection->query('SELECT * FROM dates 
INNER JOIN codes ON dates.id = codes.id;');
$query_array = $query->fetchAll();


// functions
function findDateValues($input, $connection): array{
    $query = $connection->prepare('SELECT * FROM dates 
    INNER JOIN codes ON dates.id = codes.id
    WHERE dates.date = ?');

    $query->execute([$input]);
    $query_array = $query->fetchAll();
    return $query_array;
}

function getLanguageValues($language): array{
    $values = [];
    switch($language){
        case 'Python':
            return $values=['icon'=>'python.png', 'syntax'=>'language-python'];
        case 'Javascript':
            return $values=['icon'=>'javascript.png', 'syntax'=>'language-javascript'];
        case 'Ruby':
            return $values=['icon'=>'ruby.png', 'syntax'=>'language-ruby'];
        default:
            return $values = [];
    }
}
?>