<?php

namespace App\Databases\Interfaces;

use PDO;

interface DatabaseInterface
{
    public static function getInstance() : PDO;
}