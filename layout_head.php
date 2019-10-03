<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- set the page title -->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Store Front"; ?></title>
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- custom CSS -->
    <link href="<?php echo $home_url . "libs/css/customer.css" ?>" rel="stylesheet">
  </head>
  <body>

    <!-- include the navigation bar -->
    <?php include_once 'navigation.php'; ?>

    <!-- container -->
    <div class="container">

      <?php
      // if given page title is 'Login', do not display the title
      if($page_title != "Login") {
       ?>
       <div class="col-md-12">
         <div class="page-header">
           <h1><?php echo isset($page_title) ? $page_title : "Free Login and Register Website"; ?></h1>
         </div>
       </div>
       <?php
        }
        ?>
