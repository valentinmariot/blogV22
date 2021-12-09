<?php

namespace App\fram;

class Renderer 
{
    public static function render(string $path, array $variables = [])
    {
        extract($variables);

        ob_start();
        require('../src/views/Frontend/'. $path.'.html.php');

        $pageContent = ob_get_clean();

        require('../src/views/Frontend/layout.html.php');
    }
}