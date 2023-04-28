<?php

Flight::route("GET /cvs", function(){
    Flight::json(Flight::cvService()->get_all());
 });
 
 Flight::route("GET /cv_by_id", function(){
    Flight::json(Flight::cvService()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /cvs/@id", function($id){
    Flight::json(Flight::cvService()->get_by_id($id));
 });
 
 Flight::route("DELETE /cvs/@id", function($id){
    Flight::cvService()->delete($id);
    Flight::json(['message' => "CV deleted successfully"]);
 });
 
 Flight::route("POST /cv", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "CV added successfully",
                  'data' => Flight::cvService()->add($request)
                 ]);
 });
 
 Flight::route("PUT /cv/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "CV edit successfully",
                  'data' => Flight::cvService()->update($student, $id)
                 ]);
 });

?>