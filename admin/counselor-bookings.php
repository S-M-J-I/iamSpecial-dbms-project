<?php


?>

<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">My Appointments</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Counselor Bookings</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <?php

                        if ($_SESSION["role"] == 3) {
                            include "includes/components/user-bookings.php";
                        } else {
                            if (isset($_GET["confirmWith"])) {
                                $confirmWith = $_GET["confirmWith"];
                            } else {
                                $confirmWith = "";
                            }

                            if ($confirmWith != "") {
                                include "includes/components/bookings.php";
                            } else {
                                // * render all appointments here
                                include "includes/components/all-bookings.php";
                            }

                            if (isset($_GET["status"])) {
                                completeBooking($_GET["id"]);
                            }
                        }




                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "includes/components/footer.php" ?>