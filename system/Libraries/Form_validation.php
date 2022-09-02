<?php

class Form_validation
{

    public function run()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST == true) {
                $keys = str_word_count(implode(' ', array_keys($_POST)));
                $values = str_word_count(implode(' ', array_values($_POST)));

                if ($keys === $values) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($_GET == true) {
                $keys = str_word_count(implode(' ', array_keys($_GET)));
                $values = str_word_count(implode(' ', array_values($_GET)));

                if ($keys === $values) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
