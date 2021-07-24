<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="./">
            <img class="avatar" src="<?php echo 'https://cdn.discordapp.com/avatars/'.$_SESSION['user'] -> id.'/'.$_SESSION['user'] -> avatar; ?>">
            <?=$_SESSION['user'] -> username?>#<?=$_SESSION['user'] -> discriminator?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" href="./results">Results</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=SITE_URL;?>?action=logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>