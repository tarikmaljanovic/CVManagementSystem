<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/EducationalInstitutionsDao.class.php";

  class EducationalInstitutionService extends BaseService{
    public function __construct(){
        parent::__construct(new EducationalInstitutionsDao);
    } 
  }
?>