<?php

namespace iutnc\mf\router;

class Router extends AbstractRouter{

    public function addRoute(string $name, string $action, string $ctrl): void
    {
        self::$aliases[$name] = $ctrl;
        self::$routes[$action] = $ctrl;
    }

    public function run(): void
    {
        
    }

    public function setDefaultRoute(string $action): void
    {
        self::$aliases["default"] = self::$routes[$action];
    }

    public function urlFor(string $name, array $params = []): string
    {
        return '';
    }

    public function routes(){
        return self::$routes;
    }
}