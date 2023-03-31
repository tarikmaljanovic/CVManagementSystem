<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/ExperiencesDao.class.php";

  class ExperienceService extends BaseService{
    public function __construct(){
        parent::__construct(new ExperiencesDao);
    } 
  }
?>