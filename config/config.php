<?php

require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use Dotenv\Dotenv;


try {
    $dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
    $dotenv->load();
} catch (Exception $e) {
    printf("Ошибка при подключении окружения: %s в файле %s(%d)", $e->getMessage(), $e->getFile(), $e->getLine());
    exit(1);
}

define('MYSQL_ROOT_PASSWORD', $_ENV['MYSQL_ROOT_PASSWORD']);
define('MYSQL_DATABASE', $_ENV['MYSQL_DATABASE']);
define('MYSQL_USER', $_ENV['MYSQL_USER']);
define('MYSQL_PASSWORD', $_ENV['MYSQL_PASSWORD']);
define('MYSQL_HOST', $_ENV['MYSQL_HOST']);

define('PROJECT_DIR', dirname(__DIR__, 1));

const EXCEL_FILE_PATH = PROJECT_DIR . DIRECTORY_SEPARATOR . "file" . DIRECTORY_SEPARATOR . "banners_daily_report.xlsx";
const Template = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "main_template.php";
const NotFound = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "not_found.php";
const Result = PROJECT_DIR . DIRECTORY_SEPARATOR . "view" . DIRECTORY_SEPARATOR . "result.php";

