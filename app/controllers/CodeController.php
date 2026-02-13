<?php

// i will create some comments just i dont get lost here ;_;

// remember to put this on models!!
$query = $connection->query('SELECT * FROM dates 
INNER JOIN codes ON dates.code_id = codes.id;');
$query_array = $query->fetchAll();
rsort($query_array);

// create available dates array
$available_dates = [];
foreach ($query_array as $date) {
    array_push($available_dates, $date['date']);
}
rsort($available_dates);

// get the date selected
$input = $_GET['dates'] ?? $available_dates[0];

// get values related with the selected date
if (isset($input)) {
    if (in_array($input, $available_dates)) {
        $values = findDateValues($input, $connection);
    } else {
        $values = findDateValues($available_dates[0], $connection);
    }
    $language = $values[0]['language'];
    $code = $values[0]['code'];
    $output = $values[0]['output'];
}

// get language icon and formatting syntax
$language_values = match ($language) {
    'Python' => ['icon' => 'python.png', 'formatting' => 'language-python'],
    'JavaScript' => ['icon' => 'javascript.png', 'formatting' => 'language-javascript'],
    'Ruby' => ['icon' => 'ruby.png', 'formatting' => 'language-ruby'],
    'Php' => ['icon' => 'php.png', 'formatting' => 'language-php'],
    'Java' => ['icon' => 'java.png', 'formatting' => 'language-java'],
    'Go' => ['icon' => 'go.png', 'formatting' => 'language-go'],
    'C#' => ['icon' => 'csharp.png', 'formatting' => 'language-csharp'],
    'C++' => ['icon' => 'cpp.png', 'formatting' => 'language-cpp']
};

//get output
$user_output = $_GET['output'] ?? '';
$user_output = str_replace(" ", "", $user_output);

//get result
$result = match ($user_output) {
    $output => 'Correct',
    '' => '',
    default => 'Incorrect',
};

//get options
$options = [];

foreach ($query_array as $values) {
    $options[] = [
        'date' => $values['date'],
        'language' => $values['language'],
        'selected' => isset($_GET['dates']) && $_GET['dates'] == $values['date']
    ];
}