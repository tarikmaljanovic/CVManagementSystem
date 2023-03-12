<?php
  require "vendor/autoload.php";

  Flight::route('/', function() {
    echo "Hellp";
  });

  Flight::start();
?>