<?php

namespace Rafa\Dailycode\services;

use PDO;
use PDOException;
class AdminService
{
    public string $error = '';
    public function delete(PDO $connection)
    {
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $delete_id_codes = $_POST['delete_id_codes'] ?? null;
        $delete_id_dates = $_POST['delete_id_dates'] ?? null;

        try {
            if (isset($delete_id_codes)) {
                $query = $connection->prepare('DELETE FROM dates WHERE code_id = :id'); //because of foreign key
                $query->execute([':id' => $delete_id_codes]);
                $query = $connection->prepare('DELETE FROM codes WHERE id = :id');
                $query->execute([':id' => $delete_id_codes]);
                return 'correct';
            } else if (isset($delete_id_dates)) {
                $query = $connection->prepare('DELETE FROM dates WHERE id = :id');
                $query->execute([':id' => $delete_id_dates]);
                return 'correct';
            }
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return 'incorrect';
        }
    }
}