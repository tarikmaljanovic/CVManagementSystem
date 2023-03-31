<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/SkillsDao.class.php";

  class SkillService extends BaseService{
    public function __construct(){
        parent::__construct(new SkillsDao);
    } 
  }
?>