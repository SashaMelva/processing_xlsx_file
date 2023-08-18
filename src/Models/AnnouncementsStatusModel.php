<?php

namespace App\Models;

use Exception;
use mysqli_result;

class AnnouncementsStatusModel
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
        $sql = 'SELECT * FROM  announcements_status';
        $allData = $this->mysqli->query($sql);
        return $this->fetchAssocResult($allData);
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

}