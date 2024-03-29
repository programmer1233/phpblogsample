<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php echo $home_url; ?>">Blog</a>
        </div>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo $page_title=="Home" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>">Home</a>
                </li>
                <li>
                  <a href="<?php echo $home_url; ?>read_users.php">Users</a>
                </li>
                <li>
                  <a href="<?php echo $home_url; ?>create_user.php">Create User</a>
                </li>
            </ul>

            <?php
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Customer'){
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li <?php echo $page_title=="Edit Profile" ? "class='active'" : ""; ?>>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        &nbsp;&nbsp;<?php echo $_SESSION['firstname']; ?>
                        &nbsp;&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
            <?php
            }
            else {
            ?>
            <ul class="nav navbar-nav navbar-right">
              <li <?php echo $page_title=="Login" ? "class='active'" : ""; ?>>
                  <a href="<?php echo $home_url; ?>login">
                      <span class="glyphicon glyphicon-log-in"></span> Log In
                  </a>
              </li>

            <li <?php echo $page_title=="Register" ? "class='active'" : ""; ?>>
                <a href="<?php echo $home_url; ?>register">
                    <span class="glyphicon glyphicon-check"></span> Register
                </a>
            </li>
        </ul>

        <?php
        }
        ?>

        </div>

    </div>
</div>
