<?php


namespace App\Database\Classes;

use App\Databases\Interfaces\Connection;

class Builder
{
    private $query;
    private $table;
    private $modelName;

    public function __construct(string $modelName, string $table)
    {
        $this->modelName = $modelName;
        $this->table = $table;
    }

    public function save($table, $properties): array
    {
        $this->query = sprintf(
            'INSERT INTO %s (%s) value (%s)',
            $table,
            implode(', ', array_keys($properties)),
            ':' . implode(', :', array_keys($properties))
        );

        return $this->getConnect()->insert($this->query, $properties);
    }

    public function where(array $params): Builder
    {
        $this->query .= ' WHERE ';

        foreach ($params as $param) {
            $this->query .= "$this->table.$param[0]$param[1]'$param[2]'";

            if (end($params) == $param) {
                break;
            }

            $this->query .= ' AND ';
        }

        return $this;
    }

    public function get(): array
    {
        $this->query = 'SELECT * FROM ' . $this->table . $this->query;

        $results = $this->getConnect()->select($this->query);

        $arrayModels = [];
        foreach ($results as $result) {
            $model = new $this->modelName;

            foreach ($result as $key => $value) {
                $model->$key = $value;
            }

            $arrayModels[] = $model;
        }

        return $arrayModels;
    }

    public function delete()
    {
        $this->query = "DELETE FROM $this->table" . $this->query;

        return $this->getConnect()->delete($this->query);
    }

    public function update(array $properties): bool
    {
        $setProperty = [];
        foreach ($properties as $key => $value) {
            if (isset($value)) {
                $setProperty[] = "{$key}='{$value}'";
            }
        }

        $this->query = sprintf(
            'UPDATE %s SET %s %s',
            $this->table,
            implode(', ', $setProperty),
            $this->query
        );

        return $this->getConnect()->update($this->query);
    }

    public function with($table, $primaryKey, $localKey)
    {
        $this->query .= " JOIN $table ON $this->table.$primaryKey = $table.$localKey";

        return $this;
    }

    private function getConnect(): Connection
    {
        return new MySQLConnection;
    }
}