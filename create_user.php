<?php

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/category.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$category = new Category($db);

$page_title = "Create User";

include_once "layout_head.php";

echo "<div class='right-button-margin'>";
  echo "<a href='index.php' class='btn btn-default pull-right'> Home </a>";
echo "</div>";
?>

<?php
if($_POST) {

  $user->firstname = $_POST['firstname'];
  $user->lastname = $_POST['lastname'];
  $user->email = $_POST['email'];
  $user->technology = $_POST['technology'];
  $user->contact_number = $_POST['contact_number'];
  $user->category_id = $_POST['category_id'];
  $image = !empty($_FILES["image"]["name"]) ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";
  $user->image = $image;

  if($user->createUser()) {
    echo "<div class='alert alert-success'>User was created.</div>";
    echo $user->uploadPhoto();
  }
  else {
    echo "<div class='alert alert-danger'>Unable to create user.</div>";
  }
}



 ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post" enctpye="multipart/form-data">
   <table class='table table-hover table-responsive table-bordered'>

     <tr>
       <td>Firstname</td>
       <td><input type="text" name="firstname" value="<?php echo $user->firstname; ?>" class='form-control'></td>
     </tr>

     <tr>
       <td>Lastname</td>
       <td><input type="text" name="lastname" value="<?php echo $user->lastname; ?>" class='form-control'></td>
     </tr>

     <tr>
       <td>Email</td>
       <td><input type="text" name="email" value="<?php echo $user->email; ?>" class="form-control"></td>
     </tr>

     <tr>
       <td>Technology</td>
       <td><input type="text" name="technology" value="<?php echo $user->technology; ?>" class="form-control"></td>
     </tr>

     <tr>
       <td>Contact Number</td>
       <td><input type="text" name="contact_number" value="<?php $user->contact_number; ?>" class="form-control"></td>
     </tr>

     <tr>
       <td>Category</td>
       <td>
         <?php
          $stmt = $category->read();

          echo "<select class='form-control' name='category_id'>";
            echo "<option>Select Category...</option>";

            while($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
              extract($row_category);
              echo "<option value='{$id}'>{$name}</option>";
            }

            echo "</select>";

          ?>
       </td>
     </tr>

     <tr>
       <td>Photo</td>
       <td><input type="file" name="image"></td>
     </tr>

     <tr>
       <td></td>
       <td>
         <button type="submit" class="btn btn-primary">Create</button>
       </td>
     </tr>
   </table>
</form>

<?php

include_once "layout_foot.php";


 ?>
