<?php

declare(strict_types=1);

namespace fnogcps\Shortly\Models;

use fnogcps\Shortly\DBConnection;
use PDO;

final class Link
{
    private object $db;
    public function __construct(DBConnection $db = new DBConnection())
    {
        $this->db = $db->getInstance();
    }

    public function create(string $url, string $code): string
    {
        $query = $this->db->prepare('
            INSERT INTO links (code, target) VALUES (?, ?)
        ');

        $query->bindValue(1, $code, PDO::PARAM_STR);
        $query->bindValue(2, $url, PDO::PARAM_STR);
        $query->execute();
        return apache_request_headers()['Referer'] . "s/${code}";
    }

    public function get(string $code): string
    {
        $query = $this->db->prepare('
            SELECT target FROM links WHERE code = ?
        ');

        $query->bindValue(1, $code, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchColumn();
    }
}
