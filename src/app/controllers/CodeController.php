<?php
namespace Rafa\Dailycode\CodeController;

include_once "vendor/autoload.php";

use Rafa\Dailycode\Codes\Codes;
use Rafa\Dailycode\Database\Database;
use Rafa\Dailycode\Dates\Dates;
use PDO;

class CodeController
{
    private PDO $connection;
    private object $codes;
    private object $dates;
    
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connectDataBase();
        $this->codes = new Codes();
        $this->dates = new Dates();
        
        $this->codes->checkTodayDateIsInDates();
    }
    public function index()
    {
        
        $available_dates = [];
        foreach ($this->codes->getValues($this->connection) as $date) {
            array_push($available_dates, $date['date']);
        }
        rsort($available_dates);

        // get the date selected
        $input = $_GET['dates'] ?? $available_dates[0];

        // get values related with the selected date
        if (isset($input)) {
            if (in_array($input, $available_dates)) {
                $values = $this->dates->findDateValues($input, $this->connection);
            } else {
                $values = $this->dates->findDateValues($available_dates[0], $this->connection);
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

        foreach ($this->codes as $values) {
            $options[] = [
                'date' => $values['date'],
                'language' => $values['language'],
                'selected' => isset($_GET['dates']) && $_GET['dates'] == $values['date']
            ];
        }
    }
}
