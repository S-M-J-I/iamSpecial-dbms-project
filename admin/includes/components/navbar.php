    <?php

    if ($_SESSION["role"] == 2) {
        echo "<nav class='sb-topnav navbar navbar-expand' style='background-color: #dd4f5d; color: white;'>";
    } else if ($_SESSION["role"] == 3) {
        echo "<nav class='sb-topnav navbar navbar-expand' style='background-color: #2c447e'>";
    } else {
        echo "<nav class='sb-topnav navbar navbar-expand navbar-dark bg-dark'";
    }

    ?>
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php" style="color: white;"> <strong> <?php echo getRoleByID($_SESSION["role"]) ?> </strong> </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" style="color: white;" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item">
            <a class="nav-link" href="../index.php" style="color: white;"><i class="fas fa-arrow-left fa-fw"></i> <strong>BACK TO BLOG</strong></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" style="color: white;" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!"><i class="fas fa-cog"></i> Settings</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
    </nav>