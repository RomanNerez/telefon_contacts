<?php

final class Route {

    public static $routes = array();
    private static $params = array();
    public static $requestedUrl = '';

    public static function addRoute($route, $destination = null): void
    {
        if ($destination != null && !is_array($route)) {
            $route = array($route => $destination);
        }
        self::$routes = array_merge(self::$routes, $route);
    }

    public static function splitUrl($url)
    {
        return preg_split('/\//', $url, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function getCurrentUrl()
    {
        return (self::$requestedUrl?:'/');
    }

    public static function dispatch($requestedUrl = null)
    {
        if ($requestedUrl === null) {
            $url = explode('?', $_SERVER['REQUEST_URI']);
            $url = reset($url);
            $requestedUrl = urldecode(rtrim($url));
        }

        self::$requestedUrl = $requestedUrl;

        if (isset(self::$routes[$requestedUrl])) {
            self::$params = self::splitUrl(self::$routes[$requestedUrl]);
            return self::executeAction();
        }

        foreach (self::$routes as $route => $controller) {
            if (strpos($route, ':') !== false) {
                $params = array(':any', ':num');
                $regular = array('(.+)', '([0-9]+)');
                $route = str_replace($params, $regular, $route);
            }

            if (preg_match('#^'.$route.'$#', $requestedUrl, $matches)) {
                if (strpos($controller, '$') !== false && strpos($route, '(') !== false) {
                    $controller = preg_replace('#^'.$route.'$#', $controller, $requestedUrl);
                }

                self::$params = self::splitUrl($controller);

                if (!empty($matches)) {
                    unset($matches[0]);
                    self::$params = array_merge(self::$params, $matches);
                }

                break;
            }
        }

        if (empty(self::$params)) {
            self::errorPage404();
        }
        return self::executeAction();
    }

    public static function executeAction()
    {
        $path = ROOT_APP.'controllers'.DS;
        $controller = $path.self::$params[0] ?? $path.'DefaultController';
        $controller .= '.php';

        if (!file_exists($controller)) {
            throw new Exception('Controller ["'.self::$params[0].'"] not found');
        }
        require_once $controller;
        $controller = new self::$params[0]();

        if (!method_exists($controller, self::$params[1])) {
            $msg = 'Controller ["'.self::$params[0].'"] has no method ["'.self::$params[1].'"]';
            throw new Exception($msg);
        }

        $action = self::$params[1] ?? 'default_method';

        $params = array_slice(self::$params, 2);
        return call_user_func_array(array($controller, $action), $params);
    }

    public function errorPage404()
    {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location: /404');
    }
}