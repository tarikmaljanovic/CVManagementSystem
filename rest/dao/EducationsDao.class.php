<?php
  require_once 'BaseDao.class.php';

  class EducationsDao extends BaseDao {
    public function __construct() {
      parent::__construct("educations");
    }
  }
?>