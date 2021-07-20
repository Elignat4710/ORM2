<?php

namespace App\Models;

use App\Database\Classes\Builder;
use App\Models\Traits\Relations;

abstract class Model
{
    protected $table;
    protected $properties;
    protected $builder;

    public function __construct()
    {
        $this->builder = new Builder(get_class($this), $this->table);
    }

    public function save(): Model
    {
        $this->properties = $this->builder->save($this->table, $this->properties);

        return $this;
    }

    public function delete(): bool
    {
        return $this->builder->where([['id', '=', $this->properties['id']]])->delete();
    }

    public function update(): bool
    {
        return $this->builder->where(
            [['id', '=', $this->properties['id']]])
            ->update($this->properties);
    }

    public static function where(array ...$param): Builder
    {
        return (new static)->builder->where($param);
    }

    public static function find(int $id)
    {
        return (new static)->builder->where([['id', '=', $id]])->get()[0];
    }

    public static function with($table, $primaryKey, $localKey)
    {
        return (new static)->builder->with($table, $primaryKey, $localKey);
    }

    public function __set($name, $value)
    {
        return $this->properties[$name] = $value;
    }

    public function __get($name)
    {
        return $this->properties[$name];
    }
}