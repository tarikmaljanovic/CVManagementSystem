<?php
  require_once 'BaseDao.class.php';

  class CVsDao extends BaseDao {
    public function __construct() {
      parent::__construct("cvs");
    }
  }
?>