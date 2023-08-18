<?php

namespace App\Models;

use Exception;

class StatisticModel
{
    public function __construct(
        public \mysqli $mysqli
    )
    {
    }

    /**
     * @throws Exception
     */
    public function get(): array
    {
        $sql = 'SELECT * FROM  statistics';
        $allData = $this->mysqli->query($sql);
        return $this->fetchAssocResult($allData);
    }

    public function getById(int $id): false|array|null
    {
        $sql = "SELECT * FROM  statistics WHERE id = $id LIMIT 1";
        return $this->mysqli->query($sql)->fetch_row();
    }

    public function create(string $date, int $announcementsId, int $impression, int $clicks, float $spentMoney, int $coverage): void
    {
        $sql = "INSERT INTO statistics (date, announcements_id, impression,clicks, spent_money, coverage)
                VALUES('$date', $announcementsId, $impression,$clicks, $spentMoney, $coverage)
                ON DUPLICATE KEY UPDATE id = LAST_INSERT_ID(id)";
        $this->mysqli->query($sql);
    }

    /**
     * @throws Exception
     */
    private function fetchAssocResult($allData): array
    {
        $arrayData = [];
        for ($i = 1; $i <= $allData->num_rows; $i++) {
            $arrayData[$i] = mysqli_fetch_assoc($allData);
        }

        if (!is_array($arrayData)) {
            throw new Exception('Error with MySQL getting operations');
        }

        return $arrayData;
    }

    public function getByDateAndAnnouncementId(string $date, int $announcementId): false|array|null
    {
        $sql = "SELECT * FROM  statistics WHERE date = '$date' AND announcements_id = $announcementId  LIMIT 1";
        return $this->mysqli->query($sql)->fetch_row();
    }

//    public function update(string $date, int $announcementId, int $impression, int $clicks, float $spentMoney, int $coverage): void
//    {
//        $sql = "UPDATE statistics
//                    SET impression = $impression, clicks = $clicks, spent_mone = $spentMoney, coverage = $coverage
//                    WHERE date = $date AND announcements_id = $announcementId";
//        $this->mysqli->query($sql);
//    }
}