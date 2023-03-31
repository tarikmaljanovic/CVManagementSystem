<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/UserSkillsDao.class.php";

  class UserSkillService extends BaseService{
    public function __construct(){
        parent::__construct(new UserSkillsDao);
    } 
  }
?>