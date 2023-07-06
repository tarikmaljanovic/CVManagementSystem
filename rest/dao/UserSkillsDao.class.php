<?php
  require_once 'BaseDao.class.php';

  class UserSkillsDao extends BaseDao {
    public function __construct() {
      parent::__construct("user_skills");
    }

    public function getSkillsByCv($id) {
      return $this->query("SELECT * FROM user_skills WHERE cv_id = :id ", ['id' => $id]);
    }

    public function deleteSkillsByCv($id) {
      return $this->query("DELETE FROM user_skills WHERE cv_id = :id", ['id' => $id]);
    }

    public function update($data) {
      return $this->query("UPDATE user_skills
                           SET skill_name = :skill_name
                           WHERE id = :id",
                           ['skill_name' => $data['skill_name'], 'id' => $data['id']]);
    }
  }
?>