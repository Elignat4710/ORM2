<?php


namespace App\Database\Classes;


use App\Databases\Interfaces\Connection;
use PDO;

class MySQLConnection implements Connection
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = MySQLDatabase::getInstance();
    }

    public function insert($query, $properties): array
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($properties);

            $id = $this->pdo->lastInsertId();

            return array_merge($properties, ['id' => $id]);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function select($query): array
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll();
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function delete(string $query): bool
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return true;
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function update(string $query): bool
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return true;
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }
}