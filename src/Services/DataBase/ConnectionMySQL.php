<?php

namespace App\Services\DataBase;

class ConnectionMySQL
{
    private \mysqli $mysqli;

    /** @throws \Exception */
    public function __construct(
        public string $host = MYSQL_HOST,
        public string $username = MYSQL_USER,
        public string $password = MYSQL_ROOT_PASSWORD,
        public string $dataBase = MYSQL_DATABASE,
    )
    {
        $mysqli = mysqli_connect($this->host, $this->username, $this->password, $this->dataBase);

        if ($mysqli->connect_error) {
            throw new \Exception("Ошибка: " . $mysqli->connect_error);
        }

        $this->mysqli = $mysqli;
    }

    public function getMysqli(): \mysqli
    {
        return $this->mysqli;
    }
}