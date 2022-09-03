<?php
ob_start();
if (!session_id()) session_start();

require 'app/Config/Config.php';

date_default_timezone_set($config['time_zone']);

define('CS_ENVIRONMENT', $config['environment']);

function load_page()
{
    $start_time = microtime(TRUE);
    $end_time = microtime(TRUE);
    $time_taken = ($end_time - $start_time) * 1000;
    $time_taken = round($time_taken, 5);
    return "Page rendered in <strong>$time_taken</strong> seconds";
}

function cs_notification($level, $message, $file, $line)
{
    if (CS_ENVIRONMENT == 'development') {
        if ($level == 1) {
            $title = 'ERROR';
            $color = '#842029';
            $background = '#f8d7da';
            $border_color = '#f5c2c7';
        } else if ($level == 2) {
            $title = 'WARNING';
            $color = '#664d03';
            $background = '#fff3cd';
            $border_color = '#ffecb5';
        } else if ($level == 4) {
            $title = 'PARSING ERROR';
            $color = '#842029';
            $background = '#f8d7da';
            $border_color = '#f5c2c7';
        } else if ($level == 8) {
            $title = 'NOTICE ERROR';
            $color = '#842029';
            $background = '#f8d7da';
            $border_color = '#f5c2c7';
        } else if ($level == 256) {
            $title = 'USER ERROR';
            $color = '#842029';
            $background = '#f8d7da';
        } else if ($level == 512) {
            $title = 'USER WARNING';
            $color = '#664d03';
            $background = '#fff3cd';
            $border_color = '#ffecb5';
        } else if ($level == 1024) {
            $title = 'USER NOTICE ERROR';
            $color = '#842029';
            $background = '#f8d7da';
        } else if ($level == 2048) {
            $title = 'STRICT ERROR';
            $color = '#842029';
            $background = '#f8d7da';
            $border_color = '#f5c2c7';
        } else if ($level == 8191) {
            $title = 'ALL ERROR';
            $color = '#842029';
            $background = '#f8d7da';
            $border_color = '#f5c2c7';
        } else {
            $title = 'ERROR';
            $color = '#842029';
            $background = '#f8d7da';
            $border_color = '#f5c2c7';
        }


        echo "<div style='width: auto; padding-right: calc(1.5rem * 0.5); padding-left: calc(1.5rem * 0.5); margin-right: auto; margin-left: auto; height: auto; word-wrap: break-word;'>
        <div style='position: relative; padding: 1rem 1rem; margin-bottom: 1rem; margin-top: 1rem; color: $color; background-color: $background; border: 1px solid $border_color; border-radius: 0.375rem; word-wrap: break-word;'>
            <h4 style='color: inherit; margin-top: 0; word-wrap: break-word;'>$title!</h4>
            <p style='margin-bottom: 0; word-wrap: break-word;'>[{$level}] {$message} - {$file}:{$line} | <a href='https://www.google.com/search?q=" . urlencode($message) . "' target='_blank' style='font-weight: 700; color: inherit; text-decoration: none;'>Search &#10140;</a></p>
        </div>
    </div>";
    }
}

register_shutdown_function(function () {
    if (CS_ENVIRONMENT == 'development') {
        if (error_get_last()) {
            $error = (object) error_get_last();

            cs_notification(
                $error->type,
                $error->message,
                $error->file,
                $error->line
            );
        }
    }
});

if (CS_ENVIRONMENT == 'production') {
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    ini_set('track_errors', 0);
} else {
    error_reporting(0);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('track_errors', 1);
    set_error_handler('cs_notification');
}

require_once 'system/Core/App.php';
require_once 'system/Core/Controller.php';
require_once 'system/Core/Database.php';
require_once 'system/Models/Model.php';

return new App();

ob_end_flush();
