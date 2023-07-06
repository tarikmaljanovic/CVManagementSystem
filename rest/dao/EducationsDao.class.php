<?php
  require_once 'BaseDao.class.php';

  class EducationsDao extends BaseDao {
    public function __construct() {
      parent::__construct("educations");
    }

    public function getEducationByCv($id) {
      return $this->query("SELECT * FROM educations WHERE cv_id = :id ", ['id' => $id]);
    }

    public function deleteEducationByCv($id) {
      return $this->query("DELETE FROM educations WHERE cv_id = :id", ['id' => $id]);
    }

    public function update($data) {
      return $this->query("UPDATE educations
                          SET degree = :degree, field_of_study = :field_of_study, start_date = :start_date, end_date = :end_date, description = :description, edu_inst_name = :edu_inst_name
                          WHERE id = :id",
                          ['degree' => $data['degree'], 'field_of_study' => $data['field_of_study'], 'start_date' => $data['start_date'], 'end_date' => $data['end_date'], 'description' => $data['description'], 'edu_inst_name' => $data['edu_inst_name'], 'id' => $data['id']]);
    }
  }
?>