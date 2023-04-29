<?php

Flight::route("GET /users", function(){
    Flight::json(Flight::userService()->get_all());
 });
 
 Flight::route("GET /user_by_id", function(){
    Flight::json(Flight::userService()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /users/@id", function($id){
    Flight::json(Flight::userService()->get_by_id($id));
 });
 
 Flight::route("DELETE /users/@id", function($id){
    Flight::userService()->delete($id);
    Flight::json(['message' => "User deleted successfully"]);
 });
 
 Flight::route("POST /user", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "User added successfully",
                  'data' => Flight::userService()->add($request)
                 ]);
 });
 
 Flight::route("PUT /user/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "User edit successfully",
                  'data' => Flight::userService()->update($student, $id)
                 ]);
 });

 Flight::route("/", function() {
   require '../login.html';
 });

 Flight::route("GET /profile", function() {
   require '../profile.html';
 });

?>