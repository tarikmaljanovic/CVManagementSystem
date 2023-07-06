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

 /**
* @OA\Get(path="/getEducationByCv/{id}", tags={"Get Education by CV ID"}, security={{"ApiKeyAuth": {}}},
*     @OA\Parameter(in="path", name="id", description="CV ID"),
*     @OA\Response(response="200", description="Gets Education entries for a given CV")
* )
*/
 Flight::route("GET /getEducationByCv/@id", function($id){
   Flight::json(Flight::educationService()->getEducationByCv($id));
 });

 Flight::route("DELETE /delEducationByCv/@id", function($id) {
   Flight::json(Flight::educationService()->deleteEducationByCv($id));
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

 Flight::route("POST /eduUpdate", function() {
   $request = Flight::request()->data->getData();
   Flight::educationService()->update($request);
 });

?>