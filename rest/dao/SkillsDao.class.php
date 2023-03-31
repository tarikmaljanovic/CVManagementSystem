<?php
  require_once 'BaseDao.class.php';

  class SkillsDao extends BaseDao {
    public function __construct() {
      parent::__construct("skills");
    }
  }
?>