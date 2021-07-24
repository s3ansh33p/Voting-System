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
            $PAGE_NAME = 'Home';
            include_once(GLOBAL_URL.'/components/header.php');
        ?>
    </head>
    <body>

        <?php

            include_once(GLOBAL_URL.'/components/nav.php');
            include_once(GLOBAL_URL.'/components/banner.php');

        ?>

        <section class="pb-5 pt-2">
            <div class="container px-4 px-lg-5 mt-5">
                <?php
                    if (isset($_SESSION['voted'])) {
                        unset($_SESSION['voted']);
                        echo "<h3 class='text-success text-center mb-5'>Voted Successfully</h3>";
                    } else if (isset($_SESSION['updated'])) {
                        unset($_SESSION['updated']);
                        echo "<h3 class='text-success text-center mb-5'>Updated Vote Successfully</h3>";
                    }
                ?>
                <div class="row">
                    <?php
                        include_once(GLOBAL_URL.'/server/getHome.php');
                        for ($i = 0; $i < sizeof($catNames); $i++) {
                            echo '
                            <div class="col-sm-6 mb-2">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">'.$catNames[$i].'</h5>
                                    <p class="card-text">'.$catDesc[$i].'</p>
                                    <a href="'.SITE_URL.'/vote?id='.($i+1).'" class="btn btn-dark w-100">Vote now!</a>
                                </div>
                                </div>
                            </div>';
                        }
                    ?>
                </div>
            </div>
        </section>

        <?php include_once(GLOBAL_URL.'/components/footer.php'); ?>

    </body>
</html>
