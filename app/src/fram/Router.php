<?php

namespace App\fram;

class Router
{
    public static function getController()
    {
        $xml= new \DOMDocument();
        $xml->load(__DIR__ . '../../config/route.xml');
        $routes = $xml->getElementsByTagName('route');

        isset($_GET['path']) ? $path = strtolower(htmlspecialchars($_GET['path'])) : $path = '/';

        foreach ($routes as $route) {
            if($path === $route->getAttribute('path')) {
                $controllerName = 'App\\Controller\\' . $route->getAttribute('controller');
                $action = 'execute' . ucfirst($route->getAttribute('action'));
                $params = [];
                if ($route->hasAttribute('params')) {
                    $paramsArray = explode(',', $route->getAttribute('params'));
                    foreach ($paramsArray as $param) {
                        $params[$param] = $_GET[$param];
                    }
                }
                return new $controllerName($action, $params);
            }
        }
    }
}