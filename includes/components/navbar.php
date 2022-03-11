<?php

// * FIX nav-link active toggling bug
function toggleLinkActive($str)
{
    if (basename(__FILE__) == $str) {
        return "nav-link active";
    } else {
        return "nav-link";
    }
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="index.php">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class=<?php echo toggleLinkActive("forums.php") ?> aria-current="page" href="forums.php">Forums</a></li>
                <li class="nav-item"><a class=<?php echo toggleLinkActive("blogs.php") ?> aria-current="page" href="blogs.php">Blog</a></li>
                <li class="nav-item"><a class=<?php echo toggleLinkActive("login.php") ?> aria-current="page" href="login.php">Log In</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="login.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>