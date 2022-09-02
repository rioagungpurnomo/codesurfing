<?php

class Form
{
    public function open($action, $method, $attribute = [])
    {
        return '<form action="' . $action . '" method="' . $method . '" ' . implode(" ", $attribute)  . '>';
    }

    public function close()
    {
        return "</form>";
    }

    public function post($data = false, $security = false)
    {
        if ($data == false) {
            return $_POST;
        } else if ($security == true && $_POST[$data] == false) {
            return trim($_POST[$data] = true);
        } else {
            return trim($_POST[$data]);
        }
    }

    public function get($data = false, $security = false)
    {
        if ($data == false) {
            return $_GET;
        } else if ($_GET[$data] == false && $security == true) {
            return trim($_GET[$data] = true);
        } else {
            return trim($_GET[$data]);
        }
    }

    public function csrf_field()
    {
        if (!isset($_SESSION["csrf_token"])) {
            $token = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz', 100)), 0, 100);
            $_SESSION["csrf_token"] = $token;
        } else {
            $token = $_SESSION["csrf_token"];
        }

        return '<input type="hidden" name="csrf" value="' . $token . '">';
    }

    public function csrf_check()
    {
        if (isset($_SESSION['csrf_token'])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST["csrf"] == $_SESSION["csrf_token"]) {
                    unset($_SESSION["csrf_token"]);
                } else {
                    unset($_SESSION["csrf_token"]);
                    redirect(base_url('404'));
                    exit;
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if ($_GET["csrf"] == $_SESSION["csrf_token"]) {
                    unset($_SESSION["csrf_token"]);
                } else {
                    unset($_SESSION["csrf_token"]);
                    redirect(base_url('404'));
                    exit;
                }
            }
        }
    }
}
