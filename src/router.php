<?php

class Router {
    private array $routes = [];

    
    public function addRoute(string $method, string $path, callable $handler) {
        $this->routes[$method][$path] = $handler;
    }

    
    public function handle(string $uri, string $method) {
        foreach ($this->routes[$method] as $route => $handler) {
            
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);
                call_user_func_array($handler, $matches);
                return;
            }
        }

        
        http_response_code(404);
        echo json_encode(["error" => "404 - Page not found"]);
    }
}

?>

