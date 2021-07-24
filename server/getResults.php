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

    $sql = "SELECT v.nomCat, v.nomName1, v.nomName2, v.nomName3, v.nomName4, v.nomName5, v.nomName6, v.nomName7, v.userid, u.username, u.discriminator, u.avatar FROM votes v INNER JOIN users u on u.id = v.userid; ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    if ($result->num_rows > 0) {

        $voteCount = $result->num_rows;
        $preferences = [
            [12, 0, 0, 0, 0, 0, 0], // 1st Nom
            [122, 0, 0, 0, 0, 0, 0],
            [2, 0, 0, 0, 0, 0, 0],
            [33, 0, 0, 0, 0, 0, 0],
            [55, 0, 0, 0, 0, 0, 0],
            [7, 0, 0, 0, 0, 0, 0],
            [8, 0, 0, 0, 0, 0, 0]]; // 7th Nom
     
        while($row = $result->fetch_assoc()) {

            // Get votes and add to tally
            $votesArray = Array($row["nomName1"], $row["nomName2"], $row["nomName3"], $row["nomName4"], $row["nomName5"], $row["nomName6"], $row["nomName7"] );
            for ($i = 0; $i < 7; $i++) {
                $preferences[$i][($votesArray[$i]-1)]++;
            }

        }

        // Calculations
        $order = Array();
        $noTieBreaks = true;
        $layer = 0;

        while ($noTieBreaks) {
            // Get nth layer value of each array
            $calcArray = Array();
            for ($i = 0; $i < sizeof($preferences); $i++) {
                array_push($calcArray, $preferences[$i][$layer]);
            }

            $noTieBreaks = false;

            arsort($calcArray);
            if (count($calcArray) == count(array_unique($calcArray))) {
                $order = $calcArray;
            }
        }

    }

    $conn->close();

    function getMax($calcArray) {
        $max = max($calcArray);
        $keys = array_keys($calcArray, $max);
        if (sizeof($keys) == 1) {
            return $keys[0];
        }
        return 'DUPES';
    }

?>
