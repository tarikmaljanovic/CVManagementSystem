<?php

Flight::route("GET /skills", function(){
    Flight::json(Flight::skillService()->get_all());
 });
 
 Flight::route("GET /skill_by_id", function(){
    Flight::json(Flight::skillService()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /skills/@id", function($id){
    Flight::json(Flight::skillService()->get_by_id($id));
 });
 
 Flight::route("DELETE /skills/@id", function($id){
    Flight::skillService()->delete($id);
    Flight::json(['message' => "Skill deleted successfully"]);
 });
 
 Flight::route("POST /skill", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Skill added successfully",
                  'data' => Flight::skillService()->add($request)
                 ]);
 });
 
 Flight::route("PUT /skill/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "Skill edit successfully",
                  'data' => Flight::skillService()->update($student, $id)
                 ]);
 });

?>