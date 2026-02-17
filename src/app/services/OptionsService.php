<?php
namespace Rafa\Dailycode\services;

use PDO;
class OptionsService
{
    public function getAvailableOptions(object $codes, PDO $connection): array
    {
        $options = [];
        foreach ($codes->getValues($connection) as $values) {
            $options[] =
                [
                    'date' => $values['date'],
                    'language' => $values['language'],
                    'selected' => isset($_GET['dates']) && $_GET['dates'] == $values['date']
                ];
        }
        return $options;
    }
}