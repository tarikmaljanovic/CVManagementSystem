<?php

Flight::route("GET /userSkills", function(){
    Flight::json(Flight::userSkillService()->get_all());
 });
 
 Flight::route("GET /userSkill_by_id", function(){
    Flight::json(Flight::userSkillService()->get_by_id(Flight::request()->query['id']));
 });

   /**
* @OA\Get(path="/getSkillsByCv/{id}", tags={"Get Skills by CV ID"}, security={{"ApiKeyAuth": {}}},
*     @OA\Parameter(in="path", name="id", description="CV ID"),
*     @OA\Response(response="200", description="Gets Skill entries for a given CV")
* )
*/
 Flight::route("GET /getSkillsByCv/@id", function($id){
   Flight::json(Flight::userSkillService()->getSkillsByCv($id));
});

Flight::route("DELETE /delSkillsByCv/@id", function($id) {
   Flight::json(Flight::userSkillService()->deleteSkillsByCv($id));
});
 
 Flight::route("GET /userSkills", function($id){
    Flight::json(Flight::userSkillService()->get_by_id($id));
 });
 
 Flight::route("DELETE /userSkills/@id", function($id){
    Flight::userSkillService()->delete($id);
    Flight::json(['message' => "User Skill deleted successfully"]);
 });
 
 Flight::route("POST /userSkill", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "User Skill added successfully",
                  'data' => Flight::userSkillService()->add($request)
                 ]);
 });
 
 Flight::route("POST /skillUpdate", function() {
   $request = Flight::request()->data->getData();
   Flight::userSkillService()->update($request);
 });

?>