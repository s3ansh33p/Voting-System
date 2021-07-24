<?php
    include_once(GLOBAL_URL.'/server/connect.php');
    
    if(!isset($_SESSION['user'])) {
        header('location: '.SITE_URL);
        exit();
    }

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT catName, descriptor FROM categories; ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    if ($result->num_rows > 0) {
     
        $catNames = Array();
        $catDesc = Array();

        while($row = $result->fetch_assoc()) {
            array_push($catNames, $row["catName"]);
            array_push($catDesc, $row["descriptor"]);
        }

    }

    $conn->close();

?>
