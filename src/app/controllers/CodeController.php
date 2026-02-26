<?php
namespace Rafa\Dailycode\controllers;

use Rafa\Dailycode\models\Codes;
use Rafa\Dailycode\models\Database;
use Rafa\Dailycode\models\Dates;
use Rafa\Dailycode\models\Statistics;
use Rafa\Dailycode\services\LanguagesService;
use Rafa\Dailycode\services\OptionsService;
use Rafa\Dailycode\services\DailyCodeService;

use PDO;

class CodeController
{
    private PDO $connection;
    private Codes $codes;
    private Dates $dates;
    private Statistics $statistics;
    private LanguagesService $languages;
    private OptionsService $options;
    private DailyCodeService $daily_code_service;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connectDataBase();
        $this->codes = new Codes();
        $this->dates = new Dates();
        $this->languages = new LanguagesService();
        $this->options = new OptionsService();
        $this->statistics = new Statistics();
        $this->codes->checkTodayDateIsInDates($this->connection, $this->dates, $this->statistics);
    }
    public function index()
    {
        if (!isset($_SESSION['today_attempts'])) {
            $_SESSION['today_attempts'] = 0;
        }
        if (!isset($_SESSION['today_hit'])) {
            $_SESSION['today_hit'] = false;
        }

        // get available dates
        $available_dates = $this->dates->getAvailableDates($this->codes->getValues($this->connection));

        // get the date selected
        $input = $_GET['dates'] ?? $available_dates[0];

        // organize view values
        $this->daily_code_service = new DailyCodeService($this->dates, $this->codes, $this->connection, $this->languages, $this->options, $this->statistics);
        $view_values = $this->daily_code_service->OrganizeViewValues($input, $available_dates);
        extract($view_values);

        // get statistics  for DOM
        $global_attempts_today = $this->statistics->getAttempts($this->connection);
        $global_hits_today = $this->statistics->getHits($this->connection);

        // load index
        include_once __DIR__ . "/../views/index.php";
    }
}
