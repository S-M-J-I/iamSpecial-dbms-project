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

                <div class="row">
                    <?php include "includes/components/profile_pages/view_user.php" ?>
                </div>
            </div>
        </main>
        <?php include "includes/components/footer.php" ?>