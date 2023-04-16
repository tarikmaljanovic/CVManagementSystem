<?php
  require '../vendor/autoload.php';
  require 'services/UserService.php';
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

  Flight::register('user', 'UserService');

  Flight::route('/', function() {
    require '../login.html';
  });

  Flight::route('GET /profile', function() {
    require '../profile.html';
  });

  Flight::route("GET /users", function(){
    Flight::json(Flight::user()->get_all());
 });

 Flight::route("POST /user", function(){
  $request = Flight::request()->data->getData();
  Flight::json(['message' => "User added successfully",
                'data' => Flight::user()->add($request)
               ]);
});

  Flight::start();
?>