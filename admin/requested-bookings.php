<?php


?>

<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Requested</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Counselor Bookings</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <?php

                        if (isset($_GET["edit"])) {
                            // 
                            include "includes/components/edit-appointment.php";
                        } else if (isset($_GET["approved"])) {
                            //
                            approveBookingByID($_GET["approved"]);
                        } else {
                            include "includes/components/all-requested-bookings.php";
                        }






                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "includes/components/footer.php" ?>