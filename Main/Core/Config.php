<?php

class Config {
    private static $config = null;

    public static function load() {
        if (self::$config === null) {
            self::$config = require_once __DIR__ . '/../config/config.php';
        }
    }

    public static function get($key) {
        self::load();
        
        $keys = explode('.', $key);
        $value = self::$config;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return null;
            }
            $value = $value[$k];
        }

        return $value;
    }
}