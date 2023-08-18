<?php

namespace App\Models;

class AnnouncementsGroupsModel
{
    public function __construct(
        public \mysqli $mysqli
    )
    {
    }

    public function getById(int $id): false|array|null
    {
        $sql = "SELECT * FROM  announcements_groups WHERE id = $id LIMIT 1";
        return $this->mysqli->query($sql)->fetch_row();
    }

    public function createGroup(int $id, string $name, string $description): void
    {
        $sql = "INSERT INTO announcements_groups (id, name, description) 
                VALUES($id, $name, $description)";
        $this->mysqli->query($sql);
    }
}