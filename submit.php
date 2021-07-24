<?php

    include_once('config.php');

    if(!isset($_SESSION['user'])) {
        header('location: '.SITE_URL);
        exit();
    }
    
    if (!isset($_GET['data']) || !isset($_GET['id'])) {
        echo "400 Bad Request";
        exit();
    }

    if (strlen($_GET['data']) != 7) {
        echo "400 Bad Request";
        exit();
    }

    include_once(GLOBAL_URL.'/server/connect.php');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sub_userid = $_SESSION['user'] -> id;
    
    $sub_cat = mysqli_real_escape_string($conn, $_GET['id']);

    $data = str_split(mysqli_real_escape_string($conn, $_GET['data']));

    // Check if the user hasn't already submitted a vote for the category
    $sql = "SELECT id from votes WHERE nomCat='$sub_cat' and userid='$sub_userid'; ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    if ($result->num_rows > 0) {
        $sql = "UPDATE votes set nomCat = '$sub_cat', nomName1 = '$data[0]', nomName2 = '$data[1]', nomName3 = '$data[2]', nomName4 = '$data[3]', nomName5 = '$data[4]', nomName6 = '$data[5]', nomName7 = '$data[6]' WHERE userid = '$sub_userid'; ";

        $_SESSION['updated'] = true;

    } else {
        $sql = "INSERT INTO votes (nomCat, nomName1, nomName2, nomName3, nomName4, nomName5, nomName6, nomName7, userid) VALUES ('$sub_cat', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$sub_userid'); ";

        $_SESSION['voted'] = true;
    }

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    $conn->close();

    header('location: '.SITE_URL);
    exit();

?>
