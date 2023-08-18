<?php

require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";

use App\Services\DataBase\ConnectionMySQL;
use App\Services\DataBase\MigrationData;
use App\Services\DataBase\MigrationTable;


//Run the file to create tables and fill the database with basic data

$connection = (new ConnectionMySQL())->getMysqli();
$migrationTable = (new MigrationTable($connection));
$migrationData = (new MigrationData($connection));


$migrationTable->tableAnnouncementsStatus();
$migrationTable->tableCompanies();
$migrationTable->tableGroups();
$migrationTable->tableAnnouncements();
$migrationTable->tableStatistics();

$migrationData->dataAnnouncementsStatus();
$migrationData->dataCompanies();