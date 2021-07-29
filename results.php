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
                        if (!isset($allResults)) {
                            echo '<h3 class="text-danger">No results</h3>';
                        } else {
                            $colID = 0;
                            for ($i = 0; $i < sizeof($catNames); $i++) {
                                echo '
                                <div class="col-sm-6 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Votes for '.$catNames[$i].'</h3>';
                                        if (isset($allResults[$i])) {
                                            for ($j = 0; $j < 7; $j++) {
                                                $colID++;
                                                $keyIndex = array_keys($allResults[$i])[$j];
                                                $sumVotes = array_sum($allResults[$i]);
                                                $percent = (round($allResults[$i][$keyIndex] / $sumVotes * 10000) / 100);
                                                echo '<div class="d-flex justify-content-between mt-3">
                                                    <a data-bs-toggle="collapse" href="#col-'.$colID.'" role="button" aria-expanded="false" aria-controls="col-'.$colID.'">'.$nominations[array_keys($nominations)[$i]][$keyIndex].'</a>
                                                    <label>'.$percent.'%</label>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: '.$percent.'%" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <label>'.$allResults[$i][$keyIndex].' points</label>';
                                                echo '<div class="collapse" id="col-'.$colID.'">
                                                <div class="card card-body mt-2">
                                                    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                                </div>
                                                </div>';
                                            }
                                        } else {
                                            for ($j = 0; $j < 7; $j++) {
                                                echo '<div class="d-flex justify-content-between mt-3">
                                                    <label>'.$nominations[array_keys($nominations)[$i]][$j].'</label>
                                                    <label>0%</label>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <label>0 points</label>';
                                            }
                                        }
                                    echo '
                                    </div>
                                </div>
                            </div>';
                            }

                        }
                ?>
                </div>
            </div>
        </section>

        <?php include_once(GLOBAL_URL.'/components/footer.php'); ?>

    </body>
</html>
