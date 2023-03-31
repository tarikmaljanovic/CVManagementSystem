<?php
  require_once 'BaseDao.class.php';

  class UserSkillsDao extends BaseDao {
    public function __construct() {
      parent::__construct("user_skills");
    }
  }
?>