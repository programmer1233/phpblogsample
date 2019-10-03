<?php
error_reporting(E_ALL);

session_start();

// set default timezone
date_default_timezone_set('Europe/Belgrade');

// home page url
$home_url = "http://localhost/php-blog/";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 5;

$from_record_num = ($records_per_page * $page) - $records_per_page;




 ?>
