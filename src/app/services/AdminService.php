<?php

namespace Rafa\Dailycode\services;

use PDO;
use PDOException;
class AdminService
{
    public string $error = '';
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function delete()
    {
        $delete_id_codes = $_POST['delete_id_codes'] ?? null;
        $delete_id_dates = $_POST['delete_id_dates'] ?? null;

        try {
            if (isset($delete_id_codes)) {
                $query = $this->connection->prepare('DELETE FROM dates WHERE code_id = :id'); //because of foreign key
                $query->execute([':id' => $delete_id_codes]);
                $query = $this->connection->prepare('DELETE FROM codes WHERE id = :id');
                $query->execute([':id' => $delete_id_codes]);
                return 'correct';
            } else if (isset($delete_id_dates)) {
                $query = $this->connection->prepare('DELETE FROM dates WHERE id = :id');
                $query->execute([':id' => $delete_id_dates]);
                return 'correct';
            }
            return null;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return 'incorrect';
        }
    }
    public function insert()
    {
        $values = [
            'language' => $_POST['language'] ?? null,
            'code' => $_POST['code'] ?? null,
            'output' => $_POST['output'] ?? null,
            'date_codes' => $_POST['date_codes'] ?? null,
            'date_dates' => $_POST['date_dates'] ?? null,
            'code_id' => $_POST['code_id'] ?? null
        ];
        $insert_id_codes = $_POST['insert_id_codes'] ?? null;
        $insert_id_dates = $_POST['insert_id_dates'] ?? null;

        try {
            if (isset($insert_id_codes)) {
                $query = $this->connection->prepare('INSERT INTO codes (language, code, output, date) VALUES (:language, :code, :output, :date)');
                $query->execute(
                    [
                        ':language' => $values['language'],
                        ':code' => $values['code'],
                        ':output' => $values['output'],
                        ':date' => $values['date_codes']
                    ]
                );
                return 'correct';
            } else if (isset($insert_id_dates)) {
                $query = $this->connection->prepare('INSERT INTO dates (code_id, date) VALUES (:code_id, :date)');
                $query->execute(
                    [
                        ':code_id' => $values['code_id'],
                        ':date' => $values['date_dates']
                    ]
                );
                return 'correct';
            }
            return null;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return 'incorrect';
        }
    }
}