<?php

Flight::route("GET /experiences", function(){
    Flight::json(Flight::experienceService()->get_all());
 });
 
 Flight::route("GET /experience_by_id", function(){
    Flight::json(Flight::experienceService()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /experiences/@id", function($id){
    Flight::json(Flight::experienceService()->get_by_id($id));
 });
 
 Flight::route("DELETE /experiences/@id", function($id){
    Flight::experienceService()->delete($id);
    Flight::json(['message' => "Experience deleted successfully"]);
 });
 
 Flight::route("POST /experience", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Experience added successfully",
                  'data' => Flight::experienceService()->add($request)
                 ]);
 });
 
 Flight::route("PUT /experience/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "Experience edit successfully",
                  'data' => Flight::experienceService()->update($student, $id)
                 ]);
 });

?>