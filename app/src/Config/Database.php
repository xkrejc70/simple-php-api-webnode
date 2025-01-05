<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {

    private PDO $connection;

    public function __construct(string $host, string $port, string $dbname, string $username, string $password) {
        $this->connection = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
            $username,
            $password
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}
