<?php

namespace App\Database\Classes;

use App\Databases\Interfaces\DatabaseInterface;
use PDO;

class MySQLDatabase implements DatabaseInterface
{
    private static $pdo;

    public function __construct()
    {
    }

    public static function getInstance(): PDO
    {
        if (!empty(self::$pdo)) {
            return self::$pdo;
        }

        try {
            $config = include './config.php';

            self::$pdo = new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );

            return self::$pdo;
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }
}