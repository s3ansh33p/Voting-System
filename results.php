<?php 
    include_once('config.php');
    
    if(!isset($_SESSION['user'])) {
        header('location: '.SITE_URL);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
            $PAGE_NAME = 'Results';
            include_once(GLOBAL_URL.'/components/header.php');
        ?>
    </head>
    <body>

        <?php

            include_once(GLOBAL_URL.'/components/nav.php');
            include_once(GLOBAL_URL.'/components/banner.php');

        ?>

        <section class="pb-5 pt-2">
            <div class="container px-4 px-lg-5 mt-4">
                <h1 class="text-center mb-4">Results</h1>
                <div class="row">
                <?php
                        include_once(GLOBAL_URL.'/server/getResults.php');
                        for ($i = 0; $i < sizeof($catNames); $i++) {
                            echo '
                            <div class="col-sm-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Votes for '.$catNames[$i].'</h3>';
                                    for ($j = 0; $j < 7; $j++) {
                                        $curKeyIndex = array_keys($order)[$j];
                                        $sumVotes = array_sum($order);
                                        $percent = (round($order[$curKeyIndex] / $sumVotes * 10000) / 100);
                                        echo '<div class="d-flex justify-content-between mt-3">
                                            <label>'.$nominations[array_keys($nominations)[$i]][$curKeyIndex].'</label>
                                            <label>'.$percent.'%</label>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: '.$percent.'%" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <label>'.$order[$curKeyIndex].' votes</label>';
                                    }
                                echo '
                                </div>
                            </div>
                        </div>';
                        print_r($preferences);
                        echo '<br>';
                        print_r($order);
                        echo '<br>';
                        print_r($calcArray);

                        }
                ?>
                </div>
            </div>
        </section>

        <?php include_once(GLOBAL_URL.'/components/footer.php'); ?>

    </body>
</html>
