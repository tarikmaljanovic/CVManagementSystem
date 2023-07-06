<?php
  require_once 'BaseDao.class.php';

  class ExperiencesDao extends BaseDao {
    public function __construct() {
      parent::__construct("experiences");
    }

    public function getExperienceByCv($id) {
      return $this->query("SELECT * FROM experiences WHERE cv_id = :id ", ['id' => $id]);
    }

    public function deleteExperienceByCv($id) {
      return $this->query("DELETE FROM experiences WHERE cv_id = :id", ['id' => $id]);
    }

    public function update($data) {
      return $this->query("UPDATE experiences
                           SET position = :position, start_date = :start_date, end_date = :end_date, description = :description, company_name = :company_name
                           WHERE id = :id",
                           ['position' => $data['position'], 'start_date' => $data['start_date'], 'end_date' => $data['end_date'], 'description' => $data['description'], 'company_name' => $data['company_name'], 'id' => $data['id']]);
    }
  }
?>