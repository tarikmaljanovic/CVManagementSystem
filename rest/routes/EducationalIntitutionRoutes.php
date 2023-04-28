<?php

Flight::route("GET /eduInsts", function(){
    Flight::json(Flight::educationalInstitutionService()->get_all());
 });
 
 Flight::route("GET /eduInst_by_id", function(){
    Flight::json(Flight::educationalInstitutionService()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /eduinsts/@id", function($id){
    Flight::json(Flight::educationalInstitutionService()->get_by_id($id));
 });
 
 Flight::route("DELETE /eduInsts/@id", function($id){
    Flight::educationalInstitutionService()->delete($id);
    Flight::json(['message' => "Educational Institution deleted successfully"]);
 });
 
 Flight::route("POST /eduInst", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "CV added successfully",
                  'data' => Flight::educationalInstitutionService()->add($request)
                 ]);
 });
 
 Flight::route("PUT /eduInst/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "Educational Institution edit successfully",
                  'data' => Flight::educationalInstitutionService()->update($student, $id)
                 ]);
 });

?>