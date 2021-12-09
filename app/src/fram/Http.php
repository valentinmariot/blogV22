<?php

namespace App\fram;

class Http 
{
    public static function redirect(string $url)
        {
            header("Location: $url");
            exit();
        }
}