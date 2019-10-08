<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID');

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/category.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$category = new Category($db);

$user->id = $id;

$user->readOne();

$page_title = "Update User";

include_once "layout_head.php";

echo "<div class='right-button-margin'>";
 echo "<a href='index.php' class='btn btn-default pull-right'>Read Users</a>";
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

  if($user->update()) {
    echo "<div class='alert alert-success alert-dismissable'>";
      echo "User was created.";
    echo "</div>";
  }
  else {
    echo "<div class='alert alert-danger alert-dismissable'>";
      echo "Unable to create user.";
    echo "</div>";
  }
}



 ?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
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
       <td><input type="number" name="contact_number" value="<?php $user->contact_number; ?>" class="form-control"></td>
     </tr>

     <tr>
       <td>Category</td>
       <td>
         <?php
          $stmt = $category->read();

          echo "<select class='form-control' name='category_id'>";

            echo "<option>Please Select...</option>";
            while($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $category_id = $row_category['id'];
              $category_name = $row_category['name'];

              if($user->category_id == $category_id) {
                echo "<option value='$category_id' selected>";
              } else {
                echo "<option value='$category_id'>";
              }
              echo "$category_name</option>";
            }
            echo "</select>";
          ?>
       </td>
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
