<?php

declare(strict_types=1);

namespace fnogcps\Shortly;

use Dotenv;
use PDO;
use PDOException;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "../..");
$dotenv->load();

final class DBConnection
{
    public object $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO(
                'mysql:dbname=shortly;host=localhost',
                $_ENV['DB_USER'],
                $_ENV['DB_PWD']
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $this->conn->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_OBJ
            );
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function getInstance(): object
    {
        return $this->conn;
    }
}
