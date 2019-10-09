<?php
include_once "config/core.php";

include_once 'config/database.php';
include_once 'objects/user.php';
include_once 'objects/category.php';

$require_login = true;
include_once "login_checker.php";


$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$category = new Category($db);

$page_title = "Read Users";

include_once 'layout_head.php';


echo "<div class='col-md-12'>";

  $stmt = $user->readAll($from_record_num, $records_per_page);

  $page_url = "read_users.php?";

  $total_rows = $user->countAll();

  include_once "read_users_template.php";

echo "</div>";


include 'layout_foot.php';



 ?>
