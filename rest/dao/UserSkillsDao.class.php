<?php
  require_once 'BaseDao.class.php';

  class UserSkillsDao extends BaseDao {
    public function __construct() {
      parent::__construct("user_skills");
    }

    public function getSkillsByCv($id) {
      $result = $this->query("SELECT * FROM user_skills WHERE cv_id = '$id'");
      return $result;
    }
  }
?>