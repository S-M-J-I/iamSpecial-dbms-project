<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="index.php"> <img width="300" src="images/resources/brand.png" alt="" srcset=""> </a>
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
                <li class='nav-item'><a class='nav-link active' aria-current='page' href='donate.php'><strong>Donate❤️</strong></a></li>
                <?php
                if (isset($_SESSION["role"])) {
                    if ($_SESSION["role"] == 3) {
                        echo "<li class='nav-item'><a class='btn btn-primary' style='background-color: #43DBAD;border:none;' aria-current='page' href='bookings.php'><strong>Book an appointment</strong></a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='btn btn-primary' style='background-color: #43DBAD;border:none;' aria-current='page' href='chat.php'><strong>Chats</strong></a></li>";
                    }
                    echo "
                    <li class='nav-item'><a class='nav-link active' aria-current='page' href='./admin/index.php'><strong>Dashboard</strong></a></li>
                    ";
                } else {
                    echo "
                    <li class='nav-item'><a class='nav-link' aria-current='page' href='login.php'>Log In</a></li>
                    <li class='nav-item'><a class='btn btn-primary' style='background-color: #43DBAD;border:none;' aria-current='page' href='signup.php'><strong>Sign Up</strong></a></li>
                    ";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>