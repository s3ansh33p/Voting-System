<?php include_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php
            $PAGE_NAME = 'Home';
            include_once(GLOBAL_URL.'/components/header.php');
        ?>
    </head>
    <body>

        <div class="my-5 container text-center">
            <h2 class="text-success mb-2">You have been successfully logged out</h2>
            <a href="<?=SITE_URL;?>"><h4>Click here to login again</h4></a>
        </div>

    </body>
</html>
