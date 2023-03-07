<?php 
  require 'vendor/autoload.php';

  Flight::route('/', function() {
    echo "hi";
  });

  Flight::start();
?>