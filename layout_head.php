<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Store Front"; ?></title>
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="<?php echo $home_url . "/libs/css/customer.css" ?>">
  </head>
  <body>

    <!-- container -->
    <div class="container">
      <?php
      if($page_title != "Login"){
       ?>
       <div class="col-md-12">
        <div class="page-header">
          <h1><?php echo isset($page_title) ? $page_title : "PHP Blog"; ?></h1>
        </div>
       </div>
       <?php
        }
        ?>
