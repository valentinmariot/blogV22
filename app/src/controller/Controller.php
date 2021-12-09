<?php

namespace App\controllers;

abstract class Controller
{
    protected $model;
    protected $modelName;

    public function __construct($action, $params)
    {
        $method = 'execute'.ucfirst($action);
        if(is_callable([$this,$method])){
            die('io');
            $this->$method(extract($params));
        }
    }
}