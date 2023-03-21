<?php

declare(strict_types=1);

namespace fnogcps\Shortly;

use Dotenv;
use PDO;
use PDOException;

final class DBConnection
{
    private object $conn;
    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../..');
        $dotenv->load();

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
