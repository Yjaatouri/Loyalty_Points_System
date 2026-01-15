<?php

class Router {
    private $routes = [];
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function get($path, $handler) {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler) {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute($method, $path, $handler) {
        $this->routes[] = ['method' => $method, 'path' => $path, 'handler' => $handler];
    }

    public function dispatch($uri, $method) {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/');
        $uri = $uri === '' ? '/' : $uri;

        foreach ($this->routes as $route) {
            $pattern = preg_replace('#\{(\w+)\}#', '(\d+)', $route['path']); 
            $pattern = '#^' . str_replace('/', '\/', $pattern) . '$#';

            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                array_shift($matches); 
                list($controllerName, $action) = explode('::', $route['handler']);
                $controllerClass = "Controllers\\$controllerName";
                $controller = new $controllerClass($this->container);
                call_user_func_array([$controller, $action], $matches);
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}