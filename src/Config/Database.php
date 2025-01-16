<?php

namespace App\Config;

use PDO;

class Database
{
    private static $instance;

    private function __construct() {}

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new PDO(
                "mysql:host=db;dbname=nested_catgs", // "db" matches the service name in Docker Compose
                "root", // Username from the Docker Compose file
                "root", // Password from the Docker Compose file
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }
        return self::$instance;
    }
}
