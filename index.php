<?php
  require 'vendor/autoload.php';

  Flight::route('/', function() {
    require 'login.html';
  });

  Flight::start();
?>