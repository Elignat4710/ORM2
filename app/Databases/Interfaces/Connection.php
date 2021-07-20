<?php


namespace App\Databases\Interfaces;

interface Connection
{
    public function insert(string $query, array $properties) : array;

    public function select(string $query) : array;

    public function delete(string $query);

    public function update(string $query) : bool;
}