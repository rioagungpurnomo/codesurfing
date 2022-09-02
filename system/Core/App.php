<?php

class App
{
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        require_once 'app/Config/Routes.php';
        $this->controller = $route['default_controller'];
        $this->error = $route['404_override'];

        $url = $this->parseURL();

        if ($url == NULL) {
            $url = [$this->controller];
        }

        $this->route = isset($_GET['url']) && isset($route[$_GET['url']]) ? $route[$_GET['url']] : false;

        if ($this->route == true) {
            $custom_route = rtrim($this->route, '/');
            $custom_route = filter_var($custom_route, FILTER_SANITIZE_URL);
            $custom_route = explode('/', $custom_route);
        }

        // Controller
        if ($this->route == true) {
            if (file_exists('app/Controllers/' . ucfirst($custom_route[0]) . '.php')) {
                $this->controller = $custom_route[0];
                unset($_GET['url']);
            } else {
                if (file_exists('app/Controllers/' . ucfirst($this->error) . '.php')) {
                    $this->controller = $this->error;
                } else {
                    $this->controller = 'file_not_found';
                }
            }
        } else {
            if (file_exists('app/Controllers/' . ucfirst($url[0]) . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                if (file_exists('app/Controllers/' . ucfirst($this->error) . '.php')) {
                    $this->controller = $this->error;
                } else {
                    $this->controller = 'file_not_found';
                }
            }
        }

        if ($this->controller == 'file_not_found') {
            require_once 'system/Controllers/' . ucfirst($this->controller) . '.php';
        } else {
            require_once 'app/Controllers/' . ucfirst($this->controller) . '.php';
        }

        $this->controller = new $this->controller;

        // Method
        if ($this->route == true) {
            if (method_exists($custom_route[0], $custom_route[1])) {
                $this->method = $custom_route[1];
                unset($_GET['url']);
            }
        } else if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Execute Controller & Method, and pass Params if any
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
