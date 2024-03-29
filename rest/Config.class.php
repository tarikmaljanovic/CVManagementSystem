<?php

class Config {
    public static function DB_HOST(){
      return '127.0.01';
    }

    public static function DB_USERNAME(){
      return 'root';
    }

    public static function DB_PASSWORD(){
      return 'root';
    }

    public static function DB_SCHEMA(){
      return 'cv_management';
    }

    public static function JWT_SECRET(){
      return Config::get_env("JWT_SECRET", "ezcb9s8UcF");
    }

    public static function get_env($name, $default){
      return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
     }
}
?>