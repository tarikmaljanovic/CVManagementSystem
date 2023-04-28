<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/CVsDao.class.php";

  class CVService extends BaseService{
    public function __construct(){
        parent::__construct(new CVsDao);
    }
    
    public function getCvsByUser($id) {
      return $this->dao->getCvsByUser($id);
    }
  }
?>