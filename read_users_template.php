<?php

if($num > 0){

    echo "<table class='table table-hover table-responsive table-bordered'>";

    echo "<tr>";
        echo "<th>Firstname</th>";
        echo "<th>Lastname</th>";
        echo "<th>Email</th>";
        echo "<th>Type Of Developer</th>";
        echo "<th>Contact Number</th>";
        echo "<th>Actions</th>";
    echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        echo "<tr>";
            echo "<td>{$firstname}</td>";
            echo "<td>{$lastname}</td>";
            echo "<td>{$email}</td>";
            echo "<td>{$type_of_developer}</td>";
            echo "<td>{$contact_number}</td>";

            echo "<td>";
              echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>
                <span class='glyphicon glyphicon-list'></span> Read
              </a>

              <a href='update_user?id={$id}' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
              </a>

              <a delete-id='{$id}' class='btn btn-danger delete-object'>
                <span class='glyphicon glyphicon-remove'></span> Delete
              </a>";
            echo "</td>";

        echo "</tr>";
        }

    echo "</table>";

    $page_url="read_users.php?";
    $total_rows = $user->countAll();

    include_once 'paging.php';
}

else {
    echo "<div class='alert alert-danger'>
        <strong>No users found.</strong>
    </div>";
}





 ?>
