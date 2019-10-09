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
  public $category_id;
  public $technology;
  public $image;
  public $password;
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
  function create() {

    $this->created = date('Y-m-d H:i:s');

    $query = "INSERT INTO
               " . $this->table_name . "
               SET
               firstname = :firstname,
               lastname = :lastname,
               email = :email,
               contact_number = :contact_number,
               address = :address,
               password = :password,
               access_level = :access_level,
               status = :status,
               created = :created";

    $stmt = $this->conn->prepare($query);

    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
    $this->address = htmlspecialchars(strip_tags($this->address));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->access_level = htmlspecialchars(strip_tags($this->access_level));
    $this->status = htmlspecialchars(strip_tags($this->status));


    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':contact_number', $this->contact_number);
    $stmt->bindParam(':address', $this->address);

    $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password_hash);

    $stmt->bindParam(':access_level', $this->access_level);
    $stmt->bindParam(':status', $this->status);
    $stmt->bindParam(':created', $this->created);

    if($stmt->execute()){
        return true;
    } else {
        $this->showError($stmt);
        return false;
    }
  }
  public function showError($stmt){
    echo "<pre>";
        print_r($stmt->errorInfo());
    echo "</pre>";
  }
function readAll($from_record_num, $records_per_page) {

  $query = "SELECT
                id,
                firstname,
                lastname,
                email,
                contact_number,
                technology,
                access_level,
                created
            FROM " . $this->table_name . "
            ORDER BY id DESC
            LIMIT ?, ?";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt;
  }
  public function countAll() {

    $query = "SELECT id FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    $num = $stmt->rowCount();

    return $num;
  }
  function readOne() {

    $query = "SELECT
                firstname, lastname, email, technology, category_id, contact_number, image
              FROM
              " . $this->table_name . "
              WHERE id = ?
              LIMIT
                 0,1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->firstname = $row['firstname'];
    $this->lastname = $row['lastname'];
    $this->email = $row['email'];
    $this->technology = $row['technology'];
    $this->category_id = $row['category_id'];
    $this->contact_number = $row['contact_number'];
    $this->image = $row['image'];
  }
  function createUser() {
    $query = "INSERT INTO
                 " . $this->table_name . "
              SET
                 firstname = :firstname,
                 lastname = :lastname,
                 email = :email,
                 technology = :technology,
                 contact_number = :contact_number,
                 image = :image,
                 category_id = :category_id";

    $stmt = $this->conn->prepare($query);

    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->technology = htmlspecialchars(strip_tags($this->technology));
    $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
    $this->image = htmlspecialchars(strip_tags($this->image));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));

    $stmt->bindParam(":firstname", $this->firstname);
    $stmt->bindParam(":lastname", $this->lastname);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":technology", $this->technology);
    $stmt->bindParam(":contact_number", $this->contact_number);
    $stmt->bindParam(":image", $this->image);
    $stmt->bindParam(":category_id", $this->category_id);

    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  function update() {

    $query = "UPDATE
                  " . $this->table_name . "
              SET
                firstname = :firstname,
                lastname = :lastname,
                email = :email,
                technology = :technology,
                contact_number = :contact_number,
                category_id = :category_id
              WHERE
               id = :id";

    $stmt = $this->conn->prepare($query);

    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->technology = htmlspecialchars(strip_tags($this->technology));
    $this->contact_number = htmlspecialchars(strip_tags($this->contact_number));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':technology', $this->technology);
    $stmt->bindParam(':contact_number', $this->contact_number);
    $stmt->bindParam(':category_id', $this->category_id);
    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()) {
      return true;
    }
    return false;
  }
  function delete() {

    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($result = $stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function search($search_term, $from_record_num, $records_per_page) {

    $query = "SELECT
                c.name as category_name, u.id, u.firstname, u.lastname, u.email, u.technology, u.contact_number
            FROM
                " . $this->table_name . " u
                LEFT JOIN
                    categories c
                        ON u.category_id = c.id
            WHERE
                u.firstname LIKE ? OR u.technology LIKE ?
            ORDER BY
                u.firstname ASC
            LIMIT
                ?, ?";

   $stmt = $this->conn->prepare($query);

   $search_term = "%{$search_term}%";
   $stmt->bindParam(1, $search_term);
   $stmt->bindParam(2, $search_term);
   $stmt->bindParam(3, $search_term, PDO::PARAM_INT);
   $stmt->bindParam(4, $search_term, PDO:: PARAM_INT);

   $stmt->execute();

   return $stmt;
  }
  public function countAll_BySearch($search_term) {

    $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " u
                LEFT JOIN
                    categories c
                        ON u.category_id = c.id
            WHERE
                u.firstname LIKE ?";

   $stmt = $this->conn->prepare($query);

   $search_term = "%{$search_term}%";

   $stmt->bindParam(1, $search_term);

   $stmt->execute();

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   return $row['total_rows'];
  }
  function uploadPhoto() {

    $result_message = "";

    if($this->image) {

      $target_directory = "uploads/";
      $target_file = $target_directory . $this->image;
      $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

      $file_upload_error_messages = "";

      $check = getimagesize($_FILES["image"]["tmp_name"]);

      if($check !== false) {
        // submitted file is an image
      } else {
        $file_upload_error_messages .="<div>Submitted file is not an image.</div>";
      }

      $allowed_file_types = array("jpg", "jpeg", "png", "gif");
      if(!in_array($file_type, $allowed_file_types)) {
        $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
      }

      if(file_exists($target_file)) {
         $file_upload_error_messages.="<div>Image already exists. Try to change file name.</div>";
      }

      if($_FILES['image']['size'] > (1024000)) {
        $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
      }

      if(!is_dir($target_directory)) {
        mkdir($target_directory, 0777, true);
      }
    }
    if(empty($file_upload_error_messages)) {

      if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
          // it means photo is uploaded
      } else {
        $result_message.="<div class='alert alert-danger'>";
            $result_message.="<div>Unable to upload photo.</div>";
            $result_message.="<div>Update the record to upload photo.</div>";
        $result_message.="</div>";
      }
    }
    else {
      $result_message.="<div class='alert alert-danger'>";
        $result_message.="{$file_upload_error_messages}";
        $result_message.="<div>Update the record to upload photo.</div>";
    $result_message.="</div>";
    }
    return $result_message;
  }
}



 ?>
