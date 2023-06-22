<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
* register user
*/
/**
* @OA\Post(
*     path="/register",
*     description="Register to the system",
*     tags={"Register"},
*     @OA\RequestBody(description="Basic user info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="email", type="string", example="test12@gmail.com"),
*    				@OA\Property(property="username", type="string", example="test12"),
*    				@OA\Property(property="password", type="string", example="123456",	description="Password" ),
*    				)
*     )),
*     @OA\Response(
*         response=200,
*         description="JWT Token on successful response"
*     ),
*     @OA\Response(
*         response=404,
*         description="Wrong Password | User doesn't exist"
*     )
* )
*/

 Flight::route('POST /register', function(){
   $data = Flight::request()->data->getData();
   $data['passwrd'] = md5($data['passwrd']);
   $user = Flight::userService()->add($data);
   Flight::json($user);}
 );

  /**
* @OA\Post(
*     path="/login", 
*     description="Login",
*     tags={"Login"},
*     @OA\RequestBody(description="Login", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*             @OA\Property(property="email", type="string", example="user@email.com",	description="User email" ),
*             @OA\Property(property="password", type="string", example="12345678",	description="Password" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Logged in successfuly"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

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

/**
* @OA\Put(path="/update", tags={"Update user with given information"}, security={{"ApiKeyAuth": {}}},
*     @OA\Response(response="200", description="Updates the user's information in the database")
* )
*/
 Flight::route('PUT /update', function(){
  $data = Flight::request()->data->getData();

  $id = $data["id"];
  $firstname = $data['firstname'];
  $lastname = $data['lastname'];
  $email = $data['email'];

  Flight::userService()->updateProfile($id, $firstname, $lastname, $email);
 });

?>