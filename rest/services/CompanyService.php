<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/CompaniesDao.class.php";

  class CompanyService extends BaseService{
    public function __construct(){
        parent::__construct(new CompaniesDao);
    } 
  }
?>