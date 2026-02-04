<?php

// i will create some comments just i dont get lost here ;_;

// querys
$query = $connection->query('SELECT * FROM dates 
INNER JOIN codes ON dates.id = codes.id;');
$query_array = $query->fetchAll();

// create dates array
$dates = [];
foreach($query_array as $date){
    array_push($dates, $date['date']);
}
rsort($dates);

// create languages array
$languages = [];
foreach($query_array as $language){
    array_push($languages, $language['language']);
}
$languages = array_reverse($languages);

// get the date selected
$input = $_GET['dates'] ?? $dates[0];

// get values related with the selected date
if(isset($input)){
    if(in_array($input, $dates)){
        $values = findDateValues($input, $connection);
    }else{
        $values = findDateValues($dates[0], $connection);
    }    
    $language = $values[0]['language'];
    $code = $values[0]['code'];
    $output = $values[0]['output'];
}

// get language icon and formatting syntax
$language_values = getLanguageValues($language);

//get output 
$user_output = $_GET['output'] ?? '';

//get result
$result = checkUserOutput($output, $user_output);
?>