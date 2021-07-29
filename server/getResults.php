<?php
    include_once(GLOBAL_URL.'/server/connect.php');
    
    if(!isset($_SESSION['user'])) {
        header('location: '.SITE_URL);
        exit();
    }

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT c.id, c.catName, c.descriptor, n.id AS nomID, n.nomName FROM categories c INNER JOIN nominations n ON c.id = n.nomCat; ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    if ($result->num_rows > 0) {
     
        $catNames = Array();
        $catDesc = Array();
        $nominations = Array();
        $previd = 0;

        while($row = $result->fetch_assoc()) {
            if ($previd != $row["id"]) {
                $previd = $row["id"];
                array_push($catNames, $row["catName"]);
                array_push($catDesc, $row["descriptor"]);
                // Add new set of nominations for each category
                $nominations[$previd] = Array();
            }
            array_push($nominations[$previd], $row["nomName"]);
        }

    }

    $sql = "SELECT v.nomCat as curCat, v.nomName1, v.nomName2, v.nomName3, v.nomName4, v.nomName5, v.nomName6, v.nomName7, v.userid, u.username, u.discriminator, u.avatar FROM votes v INNER JOIN users u on u.id = v.userid  ORDER BY v.nomCat; ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    if ($result->num_rows > 0) {

        $voteCount = $result->num_rows;

        $allResults = Array();
        $advancedResults = Array(Array());

        $preferences = [0, 0, 0, 0, 0, 0, 0];
        $curCat = 1;
     
        while($row = $result->fetch_assoc()) {

            // Get votes and add to tally
            if ($curCat != $row["curCat"]) {
                arsort($preferences);
                array_push($allResults, $preferences);
                $preferences = [0, 0, 0, 0, 0, 0, 0];
                $curCat = $row["curCat"];
                array_push($advancedResults, Array());
            }
            

            $votesArray = Array($row["nomName1"], $row["nomName2"], $row["nomName3"], $row["nomName4"], $row["nomName5"], $row["nomName6"], $row["nomName7"] );
            for ($i = 0; $i < 7; $i++) {
                $preferences[$i] = $preferences[$i] + SCORES[$votesArray[$i]-1];
                if ($i == 6) {
                    $tmp = $votesArray;
                    array_push($tmp, [$row["username"], $row["userid"], $row["avatar"], $row["discriminator"]]);
                    array_push($advancedResults[$curCat-1], $tmp);
                }
            }

        }

        // Final push
        arsort($preferences);
        array_push($allResults, $preferences);

    }

    $conn->close();

?>
