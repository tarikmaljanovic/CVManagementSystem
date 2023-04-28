<?php
  require '../vendor/autoload.php';
  require 'services/UserService.php';
  require 'services/CompanyService.php';
  require 'services/CVService.php';
  require 'services/EducationalInstitutionService.php';
  require 'services/ExperienceService.php';
  require 'services/SkillService.php';
  require 'services/UserSkillService.php';
  require 'services/EducationService.php';
  

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

  Flight::register('userService', 'UserService');
  Flight::register('companyService', 'CompanyService');
  Flight::register('cvService', 'CVService');
  Flight::register('educationalInstitutionService', 'EducationalInstitutionService');
  Flight::register('experienceService', 'ExperienceService');
  Flight::register('educationService', 'EducationService');
  Flight::register('skillService', 'SkillService');
  Flight::register('userSkillService', 'UserSkillService');


  require './routes/CompanyRoutes.php';
  require './routes/CVRoutes.php';
  require './routes/CVRoutes.php';
  require './routes/EducationalIntitutionRoutes.php';
  require './routes/SkillRoutes.php';
  require './routes/UserRoutes.php';
  require './routes/UserSkillRoutes.php';
  require './routes/EducationRoutes.php';


  Flight::start();
?>