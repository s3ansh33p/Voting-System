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
            $PAGE_NAME = 'Vote';
            include_once(GLOBAL_URL.'/components/header.php');
        ?>
    </head>
    <body>

        <?php

            include_once(GLOBAL_URL.'/components/nav.php');
            include_once(GLOBAL_URL.'/components/banner.php');
            include_once(GLOBAL_URL.'/components/media.php');

        ?>


        <section class="pb-5 pt-2">
            <div class="container px-4 px-lg-5 mt-5">
                <?php
                    if (isset($_GET["id"])) {
        
                        include_once(GLOBAL_URL.'/server/getVote.php');

                        if (isset($cname)) {
                            echo '
                            <div class="drag-list">
                                <div class="drag-title">'.$cname.'</div>
                                <div class="drag-item-container" id="c">';
                                for ($i = 0; $i < sizeof($nominations); $i++) {
                                    echo '<div class="drag-item drag d-flex flex-column" data="'.($i+1).'">'.($i+1).') '.$nominations[$i].'
                                    '.render($_GET["id"], ($i+1)).'
                                    </div>';
                                }
                                echo '</div>
                            </div>
                            <button class="btn btn-dark w-100" onclick="submit()">Submit Vote</button>';

                        } else {

                            echo '<h3 class="text-danger">404 Not Found</h3>';

                        }

                    } else {

                        echo '<h3 class="text-danger">400 Bad Request</h3>';

                    }
                ?>
            </div>
        </section>

        <?php include_once(GLOBAL_URL.'/components/footer.php'); ?>

        <script>
            function submit() {
                let d = '';
                const c = document.getElementById("c");

                for (let i=0; i<c.childElementCount; i++) {
                    d += c.children[i].getAttribute('data');
                }

                window.location.href = `<?=SITE_URL;?>/submit?id=${(new URL(document.location)).searchParams.get('id')}&data=${d}`;
            }
        </script>

    </body>
</html>
