<?php include "includes/components/header.php" ?>

<!-- ** IF THERE IS NO SESSION ** -->
<?php

if (!isset($_SESSION["role"])) {
    include "401.php";
    return;
}

?>

<!-- Top Bar -->
<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <!-- Side navbar -->
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <!-- Main Dashboard Content -->
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <br>
                <div class="row">
                    <h4>Users</h4>
                    <hr>
                    <?php printCards("View All Users", "view_admin.php", "primary") ?>
                    <?php printCards("Verify Users", "verification.php?type=user", "success") ?>
                    <?php printCards("See Unfriendly Users", "index.php", "danger") ?>
                </div>
                <br>
                <div class="row">
                    <h4>Institutions</h4>
                    <hr>
                    <?php printCards("View All Institutions", "institutions.php", "primary") ?>
                    <?php printCards("Add An Institution", "institutions.php?target=add", "success") ?>
                    <?php printCards("See Unfriendly Institutions", "index.php", "danger") ?>
                </div>
            </div>
        </main>
        <?php include "includes/components/footer.php" ?>