<?php

namespace App;

class Router
{

    private static $routers = [];

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    private static function addHandler($path, $method, $handler)
    {
        static::$routers[$path . $method] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public static function get($path, $handler)
    {
        static::addHandler($path, self::METHOD_GET, $handler);
    }

    public static function post($path, $handler)
    {
        static::addHandler($path, self::METHOD_POST, $handler);
    }


    public static function run()
    {
        $requestURI = parse_url($_SERVER['REQUEST_URI']);
        $uri = $requestURI['path'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $callback = null;

        foreach (static::$routers as $handler) {
            // echo "<pre>";
            // print_r($handler);
            if ($uri === $handler['path'] && $requestMethod === $handler['method']) {
                $callback = $handler['handler'];
            }
        }

        if (!$callback) {
            echo "404 not found";
            return;
        }

        if (is_callable($callback)) {
            return $callback();
        }

        if (is_array($callback)) {
            [$class, $method] = $callback;
            $class = new $class;
            return call_user_func_array([$class, $method], []);
        }
    }
}
