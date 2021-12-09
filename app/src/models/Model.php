<?php

namespace App\models;

use App\fram\PDOFactory;

abstract class Model
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = PDOFactory::getPdo();
    }
}