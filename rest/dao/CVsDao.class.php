<?php
  require_once 'BaseDao.class.php';

  class CVsDao extends BaseDao {
    public function __construct() {
      parent::__construct("cvs");
    }

    public function getCvsByUser($userId) {
      return $this->query("SELECT * FROM cvs WHERE user_id = :userId ", ['userId' => $userId]);
    }

    public function update($data) {
      return $this->query("UPDATE cvs SET cv_name = :cv_name, bio = :bio WHERE id = :id", ['cv_name' => $data['cv_name'], 'bio' => $data['bio'], 'id' => $data['id']]);
    }
  }
?>