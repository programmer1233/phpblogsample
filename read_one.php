<?php

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/category.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$category = new Category($db);

$user->id = $id;

$user->readOne();

$page_title = 'Read One User';
include_once 'layout_head.php';

echo "<div class='right-button-margin'>";
  echo "<a href='index.php' class='btn btn-primary pull-right'>";
    echo "<span class='glyphicon glyphicon-list'></span> Read Users";
  echo "</a>";
echo "</div>";

echo "<table class='table table-hover table-responsive table-bordered'>";

    echo "<tr>";
      echo "<td>Firstname</td>";
      echo "<td>{$user->firstname}</td>";
    echo "</tr>";

    echo "<tr>";
      echo "<td>Lastname</td>";
      echo "<td>{$user->lastname}</td>";
    echo "</tr>";

    echo "<tr>";
      echo "<td>Email</td>";
      echo "<td>{$user->email}</td>";
    echo "</tr>";

    echo "<tr>";
      echo "<td>Technology</td>";
      echo "<td>{$user->technology}</td>";
    echo "</tr>";

    echo "<tr>";
      echo "<td>Contact Number</td>";
      echo "<td>{$user->contact_number}</td>";
    echo "</tr>";

    echo "<tr>";
      echo "<td>Category</td>";
      echo "<td>";
        $category->id = $user->category_id;
        $category->readName();
        echo $category->name;
      echo "</td>";
    echo "</tr>";

echo "</table>";


include_once 'layout_head.php';
 ?>
