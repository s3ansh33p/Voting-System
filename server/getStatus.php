<?php
    include_once(GLOBAL_URL.'/server/connect.php');
    
    if(!isset($_SESSION['user'])) {
        header('location: '.SITE_URL);
        exit();
    }

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM config; ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    $showVotes = false;

    if ($result->num_rows > 0) {
     
        $row = $result->fetch_assoc();
        $showVotes = $row['showVotes'];

    }

    // $conn->close();

?>
