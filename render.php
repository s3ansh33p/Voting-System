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

        <?php include_once(GLOBAL_URL.'/components/nav.php'); ?>

        <header class="bg-dark py-3">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-white">
                                        
                    <div class="text-animation-container">
                        <span class="text-animation1"></span>
                        <span class="text-animation2"></span>
                    </div>
                    
                    <svg id="filters">
                        <defs>
                            <filter id="threshold">
                                <feColorMatrix in="SourceGraphic"
                                        type="matrix"
                                        values="1 0 0 0 0
                                                        0 1 0 0 0
                                                        0 0 1 0 0
                                                        0 0 0 255 -140" />
                            </filter>
                        </defs>
                    </svg>
                </div>
            </div>
        </header>

        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="drag-list">
                    <div class="drag-title">This is a list</div>
                    <div class="drag-item-container">
                      <div class="drag-item drag">1st</div>
                      <div class="drag-item drag">2nd</div>
                      <div class="drag-item drag">3rd</div>
                      <div class="drag-item drag">4th</div>
                      <div class="drag-item drag">5th</div>
                      <div class="drag-item drag">6th</div>
                      <div class="drag-item drag">7th</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ./components/footer.php -->
        <footer class="py-3 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Sean McGinty 2021</p></div>
        </footer>
        <script src='https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
