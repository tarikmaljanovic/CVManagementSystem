<?php
  require_once 'BaseDao.class.php';

  class CVsDao extends BaseDao {
    public function __construct() {
      parent::__construct("cvs");
    }

    public function getCvsByUser($userId) {
      return $this->query("SELECT * FROM cvs WHERE user_id = :userId ", ['userId' => $userId]);
    }
  }
?>