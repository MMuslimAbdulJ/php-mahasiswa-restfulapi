<?php
/**
 * Router for web request
 */
namespace muslim\restfulapi\App;
use muslim\restfulapi\Exception\validationException;

class Router
{
    private static array $routes = []; // Array for storing the Routes

    // Method for registering existing routes from public
    public static function add(
        string $method,
        string $path,
        string $controller,
        string $function,
        array $middleware = []
    ): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware
        ];
    }

    // Run all the routes
    public static function run() : void {
        $path = '/';
        if(isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }
        $method = $_SERVER['REQUEST_METHOD'];
        foreach(self::$routes as $route) {
            $pattern = "#^". $route['path'] ."$#";
            if(preg_match($pattern, $path, $variables) && $route['method'] == $method) {
                foreach($route['middleware'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }
                array_shift($variables);
                $controller = new $route['controller'];
                $function = $route['function'];
                call_user_func_array([$controller, $function], $variables);
                return;
            }
        }
        Json::responseError('Not Found', 404, new validationException('The endpoint you requested does not exist'));
    }

}

?>