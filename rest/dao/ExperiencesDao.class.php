<?php
  require_once 'BaseDao.class.php';

  class ExperiencesDao extends BaseDao {
    public function __construct() {
      parent::__construct("experiences");
    }

    public function getExperienceByCv($id) {
      return $this->query("SELECT * FROM experiences WHERE cv_id = :id ", ['id' => $id]);
    }
  }
?>