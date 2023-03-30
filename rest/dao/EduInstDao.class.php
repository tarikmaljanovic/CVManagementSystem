<?php
  class EduInstDao {
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
  }
?>