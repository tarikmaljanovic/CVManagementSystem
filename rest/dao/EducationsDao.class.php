<?php
  require_once 'BaseDao.class.php';

  class EducationsDao extends BaseDao {
    public function __construct() {
      parent::__construct("educations");
    }

    public function getEducationByCv($id) {
      return $this->query("SELECT * FROM educations WHERE cv_id = :id ", ['id' => $id]);
    }
  }
?>