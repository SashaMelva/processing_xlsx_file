<?php

namespace App\Models;

class AnnouncementsModel
{
    public function __construct(
        public \mysqli $mysqli
    )
    {
    }

    public function getById(int $id): false|array|null
    {
        $sql = "SELECT * FROM  announcements WHERE id = $id LIMIT 1";
        return $this->mysqli->query($sql)->fetch_row();
    }

    public function create(int $id, string $name, int $companyId, int $statusId, int $groupId): void
    {
        $sql = "INSERT INTO announcements (id, name, company_id, status_id, group_id) 
            VALUES($id, '$name', $companyId, $statusId, $groupId)";
        $this->mysqli->query($sql);
    }
}