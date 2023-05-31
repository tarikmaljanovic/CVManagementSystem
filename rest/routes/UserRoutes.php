<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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

 Flight::route('PUT /update', function(){
  $data = Flight::request()->data->getData();

  $id = $data["firstname"];
  $firstname = $data['firstname'];
  $lastname = $data['lastname'];
  $email = $data['email'];

  Flight::userService()->updateProfile($id, $firstname, $lastname, $email);
 })

?>