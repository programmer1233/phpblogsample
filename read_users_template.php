<?php

echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value = isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type user firstname...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";

// create product button
echo "<div class='right-button-margin'>";
    echo "<a href='create_user.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create User";
    echo "</a>";
echo "</div>";


if($total_rows > 0){

    echo "<table class='table table-hover table-responsive table-bordered'>";

    echo "<tr>";
        echo "<th>Firstname</th>";
        echo "<th>Lastname</th>";
        echo "<th>Email</th>";
        echo "<th>Technology</th>";
        echo "<th>Contact Number</th>";
        echo "<th>Actions</th>";
    echo "</tr>";

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        echo "<tr>";
            echo "<td>{$firstname}</td>";
            echo "<td>{$lastname}</td>";
            echo "<td>{$email}</td>";
            echo "<td>{$technology}</td>";
            echo "<td>{$contact_number}</td>";

            echo "<td>";
              echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>
                <span class='glyphicon glyphicon-list'></span> Read
              </a>

              <a href='update_user.php?id={$id}' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edit
              </a>

              <a delete-id='delete_user.php?id={$id}' class='btn btn-danger delete-object'>
                <span class='glyphicon glyphicon-remove'></span> Delete
              </a>";
            echo "</td>";

        echo "</tr>";
        }

    echo "</table>";

    include_once 'paging.php';
}

else {
    echo "<div class='alert alert-danger'>No users found.</div>";
}





 ?>
