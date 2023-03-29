<?php
  require 'vendor/autoload.php';
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

  Flight::route('/', function() {
    require "html_docs/login.html";
  });

  Flight::route('GET /profile', function() {
    require 'html_docs/profile.html';
  });

  Flight::start();
?>