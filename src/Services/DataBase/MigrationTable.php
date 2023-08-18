<?php

namespace App\Services\DataBase;

class MigrationTable
{
    public function __construct(
        public \mysqli $mysqli
    )
    {
    }

    public function tableStatistics(): void
    {
        $sql = 'CREATE TABLE statistics
            (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                date DATE NOT NULL,
                announcements_id INT NOT NULL,
                impression INT,
                clicks INT,
                spent_money DECIMAL,
                coverage INT,
                CONSTRAINT FK_statistics_To_announcements FOREIGN KEY (announcements_id)  REFERENCES announcements (id)
            )';

        $this->mysqli->query($sql);
    }
    public function tableAnnouncements(): void
    {
        $sql = 'CREATE TABLE announcements
            (
                id INT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                company_id INT NOT NULL,
                status_id INT NOT NULL,
                group_id INT NOT NULL,
                CONSTRAINT FK_announcements_To_status FOREIGN KEY (status_id)  REFERENCES announcements_status (id),
                CONSTRAINT FK_announcements_To_groups FOREIGN KEY (group_id)  REFERENCES announcements_groups (id),
                CONSTRAINT FK_announcements_To_companies FOREIGN KEY (company_id)  REFERENCES companies (id)
            )';

        $this->mysqli->query($sql);
    }

    public function tableAnnouncementsStatus(): void
    {
        $sql = 'CREATE TABLE announcements_status
            (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                description VARCHAR(200)
            )';

        $this->mysqli->query($sql);
    }

    public function tableCompanies(): void
    {
        $sql = 'CREATE TABLE companies
            (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                description VARCHAR(200)
            )';

        $this->mysqli->query($sql);
    }

    public function tableGroups(): void
    {
        $sql = 'CREATE TABLE announcements_groups
            (
                id INT NOT NULL PRIMARY KEY,
                name VARCHAR(50) NOT NULL,
                description VARCHAR(200)
            )';

        $this->mysqli->query($sql);
    }
}