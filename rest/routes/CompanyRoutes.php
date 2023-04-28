<?php

Flight::route("GET /companies", function(){
    Flight::json(Flight::companyService()->get_all());
 });
 
 Flight::route("GET /company_by_id", function(){
    Flight::json(Flight::companyService()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /companies/@id", function($id){
    Flight::json(Flight::companyService()->get_by_id($id));
 });
 
 Flight::route("DELETE /companies/@id", function($id){
    Flight::companyService()->delete($id);
    Flight::json(['message' => "Company deleted successfully"]);
 });
 
 Flight::route("POST /company", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "Company added successfully",
                  'data' => Flight::companyService()->add($request)
                 ]);
 });
 
 Flight::route("PUT /company/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "Company edit successfully",
                  'data' => Flight::companyService()->update($student, $id)
                 ]);
 });

?>