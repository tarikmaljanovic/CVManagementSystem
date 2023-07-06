<?php
  require_once 'BaseService.php';
  require_once __DIR__."/../dao/UserSkillsDao.class.php";

  class UserSkillService extends BaseService{
    public function __construct(){
        parent::__construct(new UserSkillsDao);
    }
    
    public function getSkillsByCv($id) {
      return $this->dao->getSkillsByCv($id);
    }

    public function deleteSkillsByCv($id) {
      return $this->dao->deleteSkillsByCv($id);
    }

    public function update($data) {
      return $this->dao->update($data);
    }
  }
?>