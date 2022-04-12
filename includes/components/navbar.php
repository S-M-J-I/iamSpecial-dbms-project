<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="index.php">IamSpecial</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Forums
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="forums.php">Category Here</a>
                        <a class="dropdown-item" href="#">Category Here</a>
                        <a class="dropdown-item" href="#">Category Here</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Blogs
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php getAllCategoriesAsList("blogs") ?>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">About Us</a>
                        <a class="dropdown-item" href="#">Contact</a>
                    </div>
                </li>
                <?php
                if (isset($_SESSION["role"])) {
                    echo "<li class='nav-item'><a class='nav-link active' aria-current='page' href='./admin/index.php'>Dashboard</a></li>";
                } else {
                    echo "
                    <li class='nav-item'><a class='nav-link' aria-current='page' href='login.php'>Log In</a></li>
                    <li class='nav-item'><a class='btn btn-primary' aria-current='page' href='signup.php'>Sign Up</a></li>
                    ";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>