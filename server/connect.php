<?php
    $servername = DB_HOST;
    $username = DB_USER;
    $password = DB_PASS;
    $database = DB_NAME;

    // Create connection
    $conn = @mysqli_connect($servername, $username, $password, $database);
?>
