<?php
include_once ('../config/config.php');


// functions
function findDateValues($input, $connection): array{
    $query = $connection->prepare('SELECT * FROM dates 
    INNER JOIN codes ON dates.code_id = codes.id
    WHERE dates.date = ?');

    $query->execute([$input]);
    return $query->fetchAll();
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
        case 'Php':
            return $values=['icon'=>'php.png', 'formatting'=>'language-php'];
        case 'Java':
            return $values=['icon'=>'java.png', 'formatting'=>'language-java'];
        case 'Go':
            return $values=['icon'=>'go.png', 'formatting'=>'language-go'];
        case 'C#':
            return $values=['icon'=>'csharp.png', 'formatting'=>'language-csharp'];
        case 'C++':
            return $values=['icon'=>'cpp.png', 'formatting'=>'language-cpp'];
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
        $stmt = $connection->prepare('SELECT id FROM codes WHERE date=?');
        $stmt->execute([$today_date]);
        $code_data = $stmt->fetch();

        if ($code_data){
            $code_id = $code_data['id'];

        $query = $connection->prepare('INSERT IGNORE INTO dates (code_id, date) VALUES (?, ?)');
        $query->execute([$code_id, $today_date]);

        }
    }catch(Exception){
        //
    }
}

?>