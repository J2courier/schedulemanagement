<?php

require_once __DIR__ . '/Config.php';

class Logger {
    public static function error($message, $context = []) {
        error_log(sprintf("[ERROR] %s %s", 
            $message, 
            !empty($context) ? json_encode($context) : ''
        ));
    }

    public static function info($message, $context = []) {
        if (Config::get('app.debug')) {
            error_log(sprintf("[INFO] %s %s", 
                $message, 
                !empty($context) ? json_encode($context) : ''
            ));
        }
    }

    public static function debug($message, $context = []) {
        if (Config::get('app.debug')) {
            error_log(sprintf("[DEBUG] %s %s", 
                $message, 
                !empty($context) ? json_encode($context) : ''
            ));
        }
    }
}
?>
