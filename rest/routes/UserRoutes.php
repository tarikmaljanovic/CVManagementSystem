<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

 Flight::route('POST /register', function(){
   $data = Flight::request()->data->getData();
   $data['passwrd'] = md5($data['passwrd']);
   $user = Flight::userService()->add($data);
   Flight::json($user);}
 );

 Flight::route('POST /login', function(){
   $login = Flight::request()->data->getData();
   $user = Flight::userService()->getUserByEmail($login['emailLogin']);
   if (isset($user['id'])){
     if($user['passwrd'] == md5($login['passwordLogin'])){
       unset($user['passwrd']);
       $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');
       Flight::json(['token' => $jwt]);
     }else{
       Flight::json(["message" => "Wrong password"], 404);
     }
   }else{
     Flight::json(["message" => "User doesn't exist"], 404);
   }
 });

?>