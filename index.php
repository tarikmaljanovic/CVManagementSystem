<?php
  require 'vendor/autoload.php';
  require 'dao/UserDao.class.php';
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

  Flight::register('userDao', 'UserDao');

  Flight::route('/', function() {
    echo "Hello";
  });

  Flight::route('/profile', function() {
    require 'profile.html';
  });

  Flight::start();
?>