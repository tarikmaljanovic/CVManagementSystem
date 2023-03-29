<?php
  class UserDao {
    private $conn;

    public function __construct() {
      try {
        $servername = "127.0.0.1";
        $username= "root";
        $password = "stardust";
        $schema = "cv_management";

        $this->conn = new PDO ("mysql:host=$servername;dbname=$schema",$username, $password);
        
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Connection failed " . $e->getMessage();
      }
    }

    //Get all users
    public function getAllUsers() {
      $stmt = $this->conn->prepare("SELECT * FROM users");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Add new user
    public function addUser($first_name, $last_name, $email, $passwrd) {
      $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, passwrd) VALUES (':first_name', ':last_name', ':email', ':passwrd')");
      $result = $stmt->execute(['first_name'=> $first_name, 'last_name'=>$last_name, 'email'=>$email, 'passwrd'=>$passwrd]);   
    }

    //Update user information
    public function update($user_id, $first_name, $last_name, $email){
      $stmt = $this->conn->prepare("UPDATE users SET first_name=':first_name', last_name=':last_name', email =':email'  WHERE user_id=:user_id");
      $stmt->execute(['first_name'=> $first_name, 'last_name'=>$last_name, 'email'=>$email,'user_id'=>$user_id]);   
    }

    //Delete user
    public function delete($user_id){
      $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id= :user_id");
      $stmt->bindParam(':user_id', $user_id); //prevent SQL injection, we have this so when we put OR 1=1 not everything will be deleted. Security is better.
      $stmt->execute();   
    }
  }
?>