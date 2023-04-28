<?php

Flight::route("GET /educations", function(){
    Flight::json(Flight::educationService()->get_all());
 });
 
 Flight::route("GET /education_by_id", function(){
    Flight::json(Flight::educationService()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /educations/@id", function($id){
    Flight::json(Flight::educationService()->get_by_id($id));
 });
 
 Flight::route("DELETE /educations/@id", function($id){
    Flight::educationService()->delete($id);
    Flight::json(['message' => "Experience deleted successfully"]);
 });
 
 Flight::route("POST /education", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Education added successfully",
                  'data' => Flight::educationService()->add($request)
                 ]);
 });
 
 Flight::route("PUT /education/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "Education edit successfully",
                  'data' => Flight::educationService()->update($student, $id)
                 ]);
 });

?>