<?php

class Text
{
    public function random_string($type, $length)
    {
        if ($type == 'alpha') {
            $random_string = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz', $length)), 0, $length);
        }

        if ($type == 'alnum') {
            $random_string = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890', $length)), 0, $length);
        }

        if ($type == 'numeric') {
            $random_string = substr(str_shuffle(str_repeat('1234567890', $length)), 0, $length);
        }

        if ($type == 'nozero') {
            $random_string = substr(str_shuffle(str_repeat('123456789', $length)), 0, $length);
        }

        return trim($random_string);
    }

    public function excerpt($str, $startPos = 0, $maxLength = 100, $more = '...')
    {
        if (strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength - 3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= $more;
        } else {
            $excerpt = $str;
        }

        return trim($excerpt);
    }
}
