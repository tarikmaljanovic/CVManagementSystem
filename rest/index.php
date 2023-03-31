<?php
  require '../vendor/autoload.php';
  require 'services/SkillService.php';
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

  Flight::register('usersDao', 'SkillService');

  Flight::route('/', function() {
    require '../login.html';
  });

  Flight::route('GET /profile', function() {
    require '../profile.html';
  });

  Flight::route("GET /users", function(){
    Flight::json(Flight::usersDao()->get_all());
 });

  Flight::start();
?>