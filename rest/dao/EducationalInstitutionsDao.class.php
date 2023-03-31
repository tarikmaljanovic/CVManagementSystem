<?php
  require_once 'BaseDao.class.php';

  class EducationalInstitutionsDao extends BaseDao {
    public function __construct() {
      parent::__construct("educational_institutions");
    }
  }
?>