<?php
include_once ('../config/config.php');


// functions
function findDateValues($input, $connection): array{
    $query = $connection->prepare('SELECT * FROM dates 
    INNER JOIN codes ON dates.code_id = codes.id
    WHERE dates.date = ?');

    $query->execute([$input]);
    $query_array = $query->fetchAll();
    return $query_array;
}

function getLanguageValues($language): array{
    $values = [];
    switch($language){
        case 'Python':
            return $values=['icon'=>'python.png', 'formatting'=>'language-python'];
        case 'JavaScript':
            return $values=['icon'=>'javascript.png', 'formatting'=>'language-javascript'];
        case 'Ruby':
            return $values=['icon'=>'ruby.png', 'formatting'=>'language-ruby'];
        default:
            return $values = [];
    }
}

function checkUserOutput($output, $user_output){
    if(!empty($user_output)){
        if($output == $user_output){
            return 'Correct';
        }elseif($output != $user_output){
            return 'Incorrect';
        }
    }
}

function addTodayDate($connection){
    try{
        $today_date = date('Y-m-d');
        $query = $connection->prepare('INSERT INTO dates (date) VALUES (:date)');
        $query->bindValue(':date', $today_date);

        $query->execute();
    }catch(Exception){
        //
    }
}

?>