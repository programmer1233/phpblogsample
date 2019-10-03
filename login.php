<?php
include_once "config/core.php";

$page_title = "Login";

$require_login = false;
include_once "login_checker.php";

$access_denied = false;

// include page header HTML
include_once "layout_head.php";

echo "<div class='col-sm-6 col-md-4 col-md-offset-4'>";

    // alert messages will be here

    // actual HTML login form
    echo "<div class='account-wall'>";
        echo "<div id='my-tab-content' class='tab-content'>";
            echo "<div class='tab-pane active' id='login'>";
                echo "<form class='form-signin' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                    echo "<input type='text' name='email' class='form-control' placeholder='Email' required autofocus />";
                    echo "<input type='password' name='password' class='form-control' placeholder='Password' required />";
                    echo "<input type='submit' class='btn btn-lg btn-primary btn-block' value='Log In' />";
                echo "</form>";
            echo "</div>";
        echo "</div>";
    echo "</div>";

echo "</div>";

// footer HTML and JavaScript codes
include_once "layout_foot.php";

 ?>
