<?php
namespace Rafa\Dailycode\services;

use PDO;
class DailyCodeService
{
    public function __construct(private object $dates, private object $codes, private PDO $connection, private object $languages, private object $options, private object $statistics)
    {
    }
    public function OrganizeViewValues(string $input, array $available_dates)
    {

        // get values related with the selected date
        $values = $this->codes->getValuesOfSelectedDate($input, $available_dates, $this->dates, $this->connection);
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
        $options = $this->options->getAvailableOptions($this->codes, $this->connection);

        $view_values = [
            'code' => $code,
            'language_values' => $language_values,
            'result' => $result,
            'options' => $options
        ];
        return $view_values;
    }
    public function UpdateStatistics()
    {
        if (!isset($_GET['attempts'], $_GET['first_today_hit'])) {
            return;
        }

        $attempts = (int) $_GET['attempts'];
        $first_today_hit = $_GET['first_today_hit'];

        $this->statistics->process($this->connection, $first_today_hit, $attempts);
    }
}