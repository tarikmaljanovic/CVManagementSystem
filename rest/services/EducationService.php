<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/EducationsDao.class.php";

  class EducationService extends BaseService{
    public function __construct(){
        parent::__construct(new EducationsDao);
    } 

    public function getEducationByCv($id) {
      return $this->dao->getEducationByCv($id);
    }

    public function deleteEducationByCv($id) {
      return $this->dao->deleteEducationByCv($id);
    }

    public function update($data) {
      return $this->dao->update($data);
    }
  }
?>