<?php
  require_once __DIR__."/../Config.class.php";
  
  class BaseDao {
    private $conn;
    private $table_name;

    public function __construct($table_name) {
      try {
        $servername = Config::DB_HOST();
        $username = Config::DB_USERNAME();
        $password = Config::DB_PASSWORD();
        $schema = Config::DB_SCHEMA();

        $this->table_name = $table_name;

        $this->conn = new PDO ("mysql:host=$servername;dbname=$schema",$username, $password);
        
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Connection failed " . $e->getMessage();
      }
    }

    //Get all from entity
    public function get_all() {
      $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Get by ID
    public function get_by_id($id) {
      $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name." WHERE id = :id");
      $stmt->execute(['id' => $id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return reset($result);
    }

    //Delete
    public function delete($id){
      $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id=:id");
      $stmt->bindParam(':id', $id); // SQL injection prevention
      $stmt->execute();
    }

    //Add
    public function add($entity){
      $query = "INSERT INTO " . $this->table_name . " (";
      foreach ($entity as $column => $value) {
        $query .= $column.", ";
      }
      $query = substr($query, 0, -2);
      $query .= ") VALUES (";
      foreach ($entity as $column => $value) {
        $query .= ":".$column.", ";
      }
      $query = substr($query, 0, -2);
      $query .= ")";
  
      $stmt= $this->conn->prepare($query);
      $stmt->execute($entity); // sql injection prevention
      $entity['id'] = $this->conn->lastInsertId();
      return $entity;
    }

    //Update
    public function update($id, $entity, $id_column = "id"){
      $query = "UPDATE ".$this->table_name." SET ";
      foreach($entity as $name => $value){
        $query .= $name ."= :". $name. ", ";
      }
      $query = substr($query, 0, -2);
      $query .= " WHERE ${id_column} = :id";
  
      $stmt= $this->conn->prepare($query);
      $entity['id'] = $id;
      $stmt->execute($entity);
    }
  }

?>