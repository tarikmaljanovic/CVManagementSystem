<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/ExperiencesDao.class.php";

  class ExperienceService extends BaseService{
    public function __construct(){
        parent::__construct(new ExperiencesDao);
    }

    public function getExperienceByCv($id) {
      return $this->dao->getExperienceByCv($id);
    }

    public function deleteExperienceByCv($id) {
      return $this->dao->deleteExperienceByCv($id);
    }

    public function update($data) {
      return $this->dao->update($data);
    }
  }
?>