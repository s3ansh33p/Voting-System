<?php

    include_once('config.php');

    if(!isset($_SESSION['user'])) {
        header('location: '.SITE_URL);
        exit();
    }

    if ($_SESSION['user'] -> id != ADMIN_ID) {
        header('location: '.SITE_URL);
        exit();
    }
    
    include_once(GLOBAL_URL.'/server/connect.php');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE config SET showVotes = !showVotes; ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    $conn->close();

    $_SESSION['visibility'] = true;

    header('location: '.SITE_URL.'/results');
    exit();

?>
