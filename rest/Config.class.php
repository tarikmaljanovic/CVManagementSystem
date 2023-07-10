<?php

class Config {
    public static function DB_HOST(){
      return 'cv-management-system-do-user-14018578-0.b.db.ondigitalocean.com';
    }

    public static function DB_USERNAME(){
      return 'doadmin';
    }

    public static function DB_PASSWORD(){
      return 'AVNS_U_Sk0EySsyOz65j-Kds';
    }

    public static function DB_SCHEMA(){
      return 'cv_management';
    }

    public static function DB_PORT(){
      return '25060';
    }

    public static function JWT_SECRET(){
      return Config::get_env("JWT_SECRET", "ezcb9s8UcF");
    }

    public static function get_env($name, $default){
      return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
     }
}
?>