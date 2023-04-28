<?php

Flight::route("GET /userSkills", function(){
    Flight::json(Flight::userSkillService()->get_all());
 });
 
 Flight::route("GET /userSkill_by_id", function(){
    Flight::json(Flight::userSkillService()->get_by_id(Flight::request()->query['id']));
 });

 Flight::route("GET /getSkillsByCv/@id", function($id){
   Flight::json(Flight::userSkillService()->getSkillsByCv($id));
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
 
 Flight::route("PUT /userSkill/@id", function($id){
    $student = Flight::request()->data->getData();
    Flight::json(['message' => "User Skill edit successfully",
                  'data' => Flight::userSkillService()->update($student, $id)
                 ]);
 });

?>