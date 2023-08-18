<?php

namespace App\Services\DataBase;

class MigrationData
{
    public function __construct(
        public \mysqli $mysqli
    )
    {
    }

    public function dataAnnouncementsStatus()
    {
        $sql = 'INSERT INTO announcements_status (name, description)
                VALUES 
                    ("deleted", ""),
                    ("active", "")';

        $this->mysqli->query($sql);
    }

    public function dataCompanies()
    {
        $sql = 'INSERT INTO companies (name, description)
                VALUES 
                    ("vk.ads", "")';

        $this->mysqli->query($sql);
    }
}