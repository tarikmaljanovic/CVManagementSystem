<?php
  require_once 'BaseDao.class.php';

  class UsersDao extends BaseDao {
    public function __construct() {
      parent::__construct("users");
    }

    public function getUserByEmail($email){
      return $this->query_unique("SELECT * FROM users WHERE email = :email ", ['email' => $email]);
    }

    public function updateProfile($id, $firstname, $lastname, $email){
      return $this->query("UPDATE users SET first_name = :firstname, last_name = :lastname, email = :email WHERE id = :id", ['email'=> $email, 'firstname'=>$firstname, 'lastname'=>$lastname, 'id'=>$id]);
    }
  }
?>