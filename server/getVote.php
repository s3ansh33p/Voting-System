<?php
    include_once(GLOBAL_URL.'/server/connect.php');
    
    if(!isset($_SESSION['user'])) {
        header('location: '.SITE_URL);
        exit();
    }

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sub_id = mysqli_real_escape_string($conn, $_GET["id"]);

    $sql = "SELECT catName, descriptor, nomName FROM categories c INNER JOIN nominations n ON c.id = n.nomCat WHERE c.id = '$sub_id'; ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    if ($result->num_rows > 0) {
     
        $nominations = Array();

        while($row = $result->fetch_assoc()) {
            array_push($nominations, $row["nomName"]);
            $cname = $row["catName"];
        }

    }

    $conn->close();

?>
