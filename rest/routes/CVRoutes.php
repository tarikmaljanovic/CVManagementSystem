<?php
 use Dompdf\Dompdf;
Flight::route("GET /cvs", function(){
    Flight::json(Flight::cvService()->get_all());
 });
 
 Flight::route("GET /cv_by_id", function(){
    Flight::json(Flight::cvService()->get_by_id(Flight::request()->query['id']));
 });
 
 Flight::route("GET /cvs/@id", function($id){
    Flight::json(Flight::cvService()->get_by_id($id));
 });

/**
* @OA\Get(path="/getCvsByUser/{id}", tags={"Get CV by ID"}, security={{"ApiKeyAuth": {}}},
*     @OA\Parameter(in="path", name="id", description="User ID"),
*     @OA\Response(response="200", description="Gets CVs for a given user ID")
* )
*/
 Flight::route("GET /getCvsByUser/@id", function($id){
   Flight::json(Flight::cvService()->getCvsByUser($id));
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

 Flight::route("POST /cvUpdate", function() {
   $request = Flight::request()->data->getData();
   Flight::cvService()->update($request);
 });

 Flight::route('GET /pdf', function(){

   $dompdf = new Dompdf();
   $html = file_get_contents("../srt-resume.html");
   $dompdf->loadHtml(html_entity_decode($html));
   $dompdf->render();   
   return $dompdf->stream('document', array('Attachment' => 0));
 });

?>