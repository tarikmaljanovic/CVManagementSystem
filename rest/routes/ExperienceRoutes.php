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

  /**
* @OA\Get(path="/getExperienceByCv/{id}", tags={"Get Experience by CV ID"}, security={{"ApiKeyAuth": {}}},
*     @OA\Parameter(in="path", name="id", description="CV ID"),
*     @OA\Response(response="200", description="Gets Experience entries for a given CV")
* )
*/
 Flight::route("GET /getExperienceByCv/@id", function($id){
   Flight::json(Flight::experienceService()->getExperienceByCv($id));
 });

 Flight::route("DELETE /delExperienceByCv/@id", function($id) {
   Flight::json(Flight::experienceService()->deleteExperienceByCv($id));
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
 
 Flight::route("POST /expUpdate", function() {
   $request = Flight::request()->data->getData();
   Flight::experienceService()->update($request);
 });

?>