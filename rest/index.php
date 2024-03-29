<?php
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;

  require '../vendor/autoload.php';
  require 'services/UserService.php';
  require 'services/CVService.php';
  require 'services/ExperienceService.php';
  require 'services/UserSkillService.php';
  require 'services/EducationService.php';
  
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

  Flight::register('userService', 'UserService');
  Flight::register('cvService', 'CVService');
  Flight::register('experienceService', 'ExperienceService');
  Flight::register('educationService', 'EducationService');
  Flight::register('userSkillService', 'UserSkillService');

  Flight::route('/*', function(){

    //return TRUE;
    //perform JWT decode
    $path = Flight::request()->url;
    if ($path == '/login' || $path == '/register' || $path == '/docs.json' || $path == '/landing' || $path == '/profile' || $path == '/' || $path == '/template') return TRUE;
    $headers = getallheaders();
    if (@!$headers['Authorization']){
        Flight::json(["message" => $path], 403);
        Flight::json(["message" => "Authorization is missing"], 403);
        return FALSE;
    }else{
        try {
            $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
            Flight::set('user', $decoded);
            return TRUE;
        } catch (\Exception $e) {
            Flight::json(["message" => "Authorization token is not valid"], 403);
            return FALSE;
        }
    }
  });


  Flight::route("GET /landing", function() {
    require "../login.html";
  });

  Flight::route("GET /profile", function() {
    require "../profile.html";
  });

  Flight::route("GET /template", function() {
    require "../srt-resume.html";
  });

  Flight::route('/', function() {
    Flight::redirect('/landing');
  });

  Flight::route('GET /docs.json', function(){
    $openapi = \OpenApi\scan('routes');
    header('Content-Type: application/json');
    echo $openapi->toJson();
  });

  require './routes/CVRoutes.php';
  require './routes/ExperienceRoutes.php';
  require './routes/UserRoutes.php';
  require './routes/UserSkillRoutes.php';
  require './routes/EducationRoutes.php';

  Flight::start();
  
?>