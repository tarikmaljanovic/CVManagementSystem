<?php
  require_once 'BaseDao.class.php';

  class CompaniesDao extends BaseDao {
    public function __construct() {
      parent::__construct("companies");
    }
  }
?>