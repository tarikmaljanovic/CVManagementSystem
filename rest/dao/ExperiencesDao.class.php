<?php
  require_once 'BaseDao.class.php';

  class ExperiencesDao extends BaseDao {
    public function __construct() {
      parent::__construct("experiences");
    }
  }
?>