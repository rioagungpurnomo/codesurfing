<?php

class Url
{

    public function site_url($segment)
    {
        require 'app/Config/Config.php';

        $site_url = $config['base_url'];

        if (substr($site_url, strlen($site_url) - 1) == '/') {
            $url = $site_url;
        } else {
            $url = $site_url . '/';
        }

        $http = "http";
        $https = "https";

        if (!preg_match("/$http/i", $site_url) || !preg_match("/$https/i", $site_url)) {
            $isSecure = false;
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $isSecure = true;
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
                $isSecure = true;
            }
            $REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';

            $check_url = $REQUEST_PROTOCOL . '://' . $url;
        } else {
            $check_url = $url;
        }

        if (is_array($segment)) {
            $array = implode("/", $segment);
            $array_url = $check_url . $array;
        } else {
            $array_url = $check_url;
        }

        return filter_var($array_url, FILTER_SANITIZE_URL);
    }

    public function base_url($segment = false)
    {
        require 'app/Config/Config.php';

        $base_url = $config['base_url'];

        if (substr($base_url, strlen($base_url) - 1) == '/') {
            $url = $base_url;
        } else {
            $url = $base_url . '/';
        }

        $http = "http";
        $https = "https";

        if (!preg_match("/$http/i", $base_url) || !preg_match("/$https/i", $base_url)) {
            $isSecure = false;
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $isSecure = true;
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
                $isSecure = true;
            }
            $REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';

            $check_url = $REQUEST_PROTOCOL . '://' . $url . $segment;
        } else {
            $check_url = $url . $segment;
        }

        return filter_var($check_url, FILTER_SANITIZE_URL);
    }

    public function prep_url($str = '')
    {
        $http = "http";
        $https = "https";

        if (!preg_match("/$http/i", $str) || !preg_match("/$https/i", $str)) {
            $isSecure = false;
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $isSecure = true;
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
                $isSecure = true;
            }
            $REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';

            $check_url = $REQUEST_PROTOCOL . '://' . $str;
        } else {
            $check_url = $str;
        }

        return filter_var($check_url, FILTER_SANITIZE_URL);
    }

    public function url_title($str, $lowercase = FALSE, $separator = '-')
    {
        $string = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $str);
        $trim = trim($string);

        if ($separator == 'underscore') {
            $url_separator = str_replace(" ", "_", $trim);
        } else {
            $url_separator = str_replace(" ", $separator, $trim);
        }

        if ($lowercase == TRUE) {
            $url_title = strtolower($url_separator);
        } else {
            $url_title = $url_separator;
        }

        return filter_var($url_title, FILTER_SANITIZE_URL);
    }

    public function mailto($email)
    {
        return "mailto:" . filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    public function uri_string()
    {
        return ltrim($_SERVER['REQUEST_URI'], '/');
    }

    public function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}
