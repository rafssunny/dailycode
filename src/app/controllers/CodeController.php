<?php
namespace Rafa\Dailycode\controllers;

use Rafa\Dailycode\models\Codes;
use Rafa\Dailycode\models\Database;
use Rafa\Dailycode\models\Dates;
use \Rafa\Dailycode\models\Languages;
use PDO;

class CodeController
{
    private PDO $connection;
    private object $codes;
    private object $dates;
    private object $languages; 
    public array $view_values;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connectDataBase();
        $this->codes = new Codes();
        $this->dates = new Dates();
        $this->languages = new Languages();

        $this->codes->checkTodayDateIsInDates($this->connection, $this->dates);
    }
    public function index()
    {
        // get available
        $available_dates = $this->dates->getAvailableDates($this->codes->getValues($this->connection));

        // get the date selected
        $input = $_GET['dates'] ?? $available_dates[0]['date'];
        
        // get values related with the selected date
        if (in_array($input, $available_dates)) {
            $values = $this->dates->findDateValues($input, $this->connection);
        } else {
            $values = $this->dates->findDateValues($available_dates[0]['date'], $this->connection);
        }
        $language = $values[0]['language'];
        $code = $values[0]['code'];
        $output = $values[0]['output'];
    

        // get language icon and formatting syntax
        $language_values = $this->languages->getIconAndFormatting($language);

        //get output
        $user_output = $_GET['output'] ?? '';
        $user_output = str_replace(" ", "", $user_output);

        //get result
        $result = $this->codes->checkUserOutput($output, $user_output);

        //get options
        $options = [];

        foreach ($this->codes->getValues($this->connection) as $values) {
            $options[] = [
                'date' => $values['date'],
                'language' => $values['language'],
                'selected' => isset($_GET['dates']) && $_GET['dates'] == $values['date']
            ];
        }

        $view_values = [
            'code' => $code,
            'language_values' => $language_values,
            'result' => $result
        ];
        extract($view_values);

        include_once __DIR__ . "/../views/index.php";
    }
}
