<?php

class CS_Controller
{
    public function __construct()
    {
        require_once 'app/Config/Autoload.php';

        $this->libraries = $autoload['libraries'];
        $this->helper = $autoload['helper'];
        $this->model = $autoload['model'];

        foreach ($this->libraries as $lib) {
            $this->$lib = $this->libraries($lib);
        }

        foreach ($this->helper as $hel) {
            $this->$hel = $this->helper($hel);
        }

        foreach ($this->model as $mod) {
            if (preg_match("/_model/i", $mod)) {
                $this->$mod = $this->model($mod);
            } else {
                $array[$mod] = [$mod . '_model'];
                foreach ($array[$mod] as $m) {
                    $this->$m = $this->model($mod);
                }
            }
        }
    }

    public function view($view, $data = [])
    {
        if ($view != 'error_404') {
            if (file_exists('app/Views/' . $view . '.php')) {

                foreach ($data as $key => $value) {
                    $array[$key] = ['view_' . $key => $value];
                    foreach ($array[$key] as $k => $v) {
                        $this->$k = $v;
                    }
                }

                require_once 'app/Views/' . $view . '.php';
            } else {
                $data['view'] = $view;
                require_once 'app/Views/errors/error_404.php';
            }
        } else {
            if (file_exists('system/Views/' . $view . '.php')) {
                require_once 'system/Views/' . $view . '.php';
            }
        }
    }

    public function model($model)
    {
        if (file_exists('app/Models/' . ucfirst($model) . '.php')) {
            require_once 'app/Models/' . ucfirst($model) . '.php';
            return new $model;
        } else {
            echo ucfirst($model) . ' file not found!';
        }
    }

    public function session($data = false, $isset = false)
    {
        if ($data == false) {
            return $_SESSION;
        } else {
            if ($isset == true) {
                return trim(isset($_SESSION[$data]));
            } else {
                return trim($_SESSION[$data]);
            }
        }
    }

    public function libraries($libraries)
    {
        $this->autoload = isset($this->libraries) ? $this->libraries : false;

        if ($this->autoload != false && $libraries != false) {
            $search = array_search($libraries, $this->autoload, true);
            $this->lib = $this->autoload[$search];

            if (file_exists('system/Libraries/' . ucfirst($this->lib) . '.php')) {
                require_once 'system/Libraries/' . ucfirst($this->lib) . '.php';
                return new $this->lib;
            }

            if (file_exists('app/Libraries/' . ucfirst($this->lib) . '.php')) {
                require_once 'app/Libraries/' . ucfirst($this->lib) . '.php';
                return new $this->lib;
            }
        }
    }

    public function helper($helper)
    {
        $this->autoload = isset($this->helper) ? $this->helper : false;

        if ($this->autoload != false && $helper != false) {
            $search = array_search($helper, $this->autoload, true);
            $this->hel = $this->autoload[$search];

            if (file_exists('system/Helpers/' . ucfirst($this->hel) . '.php')) {
                require_once 'system/Helpers/' . ucfirst($this->hel) . '.php';
                return new $this->hel;
            }

            if (file_exists('app/Helpers/' . ucfirst($this->hel) . '.php')) {
                require_once 'app/Helpers/' . ucfirst($this->hel) . '.php';
                return new $this->hel;
            }
        }
    }
}
