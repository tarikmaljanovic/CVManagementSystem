<?php
  require 'vendor/autoload.php';
  require 'rest/dao/UserDao.class.php';
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

  Flight::register('userDao', 'UserDao');

  Flight::route('/', function() {
    require 'login.html';
  });

  Flight::start();
?>