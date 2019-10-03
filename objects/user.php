<?php

class User {

  private $conn;
  private $table_name = "users";

  public $id;
  public $firstname;
  public $lastname;
  public $email;
  public $contact_number;
  public $address;
  public $password;
  public $image;
  public $access_level;
  public $access_code;
  public $status;
  public $created;
  public $modified;

  public function __construct($db) {
    $this->conn = $db;
  }
  function emailExists() {

    $query = "SELECT id, firstname, lastname, access_level, password, status
              FROM " . $this->table_name . "
              WHERE email = ?
              LIMIT 0,1";

    $stmt = $this->conn->prepare($query);

    $this->email = htmlspecialchars(strip_tags($this->email));

    $stmt->bindParam(1, $this->email);

    $stmt->execute();

    $num = $stmt->rowCount();

    if($num > 0) {

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id = $row['id'];
      $this->firstname = $row['firstname'];
      $this->lastname = $row['lastname'];
      $this->access_level = $row['access_level'];
      $this->password = $row['password'];
      $this->status = $row['status'];

      return true;
    }
    return false;
  }
}



 ?>
