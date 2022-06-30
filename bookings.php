<?php
$title = "Bookings";
include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>

<!-- Page Content-->
<section class="pt-4">

    <?php

    if (!isVerified($_SESSION["id"])) {
        // ? redirect to verification screen
        include "includes/components/booking_screens/redir_booking.php";
        return;
    }

    ?>

    <div class="container px-lg-5" style="min-height:100vh;">
        <!-- Search widget-->
        <div class="card mb-4">
            <div class="card-header">Search</div>
            <div class="card-body">
                <form action="bookings.php" method="post">
                    <div class="row">
                        <div class='col-xl-3 col-md-6'>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="areaCheckBox">
                                <label class="form-check-label" for="areaCheckBox">
                                    <strong>By Area</strong>
                                </label>
                            </div>
                            <div style="display: none;" id="srch" class="input-group">
                                <select class="form-control" name="area">
                                    <option value="Select">Select area</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Khulna">Khulna</option>
                                </select>
                            </div>
                        </div>
                        <div class='col-xl-3 col-md-6'>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="specialityCheckBox">
                                <label class="form-check-label" for="specialityCheckBox">
                                    <strong>By Speciality</strong>
                                </label>
                            </div>
                            <div style="display: none;" id="srch2" class="input-group">
                                <input type="text" name="speciality" class="form-control" placeholder="Enter speciality...">
                            </div>
                        </div>
                        <div class='col-xl-3 col-md-6'>
                            <br>
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary" id="button-search" name="submit" type="button">Search counselors</button>
                            </div>
                        </div>
                    </div>
                </form>

                <br>
                <br>

                <br>
                <div class="row">
                    <?php

                    if (isset($_POST["submit"])) {
                        $area = mysqli_real_escape_string($connection, $_POST['area']);
                        $speciality = mysqli_real_escape_string($connection, $_POST['speciality']);

                        $sql = "SELECT DISTINCT * FROM users WHERE role=2 AND verified='T'";
                        if ($area != "Select") {
                            $sql .= " AND (state LIKE '%$area%' OR city LIKE '%$area%' OR area LIKE '%$area%')";
                        }
                        if ($speciality != "") {
                            $sql .= " AND speciality LIKE '%$speciality%'";
                        }

                        $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

                        if ($res) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "
                                <div class='card bg-light'>
                                    <div class='card-body'>
                                        <div class='row'>
                                            <div class='col-xl-3 col-md-6'>
                                                <img src='images/avatars/{$row['avatar']}?1234324' width=250px/>
                                            </div>
                                            <div class='col-xl-6 col-md-4'>
                                                <p><h4><strong>Dr. {$row['first_name']} {$row['last_name']}</strong></h4></p>
                                                <p><strong>Specialities:</strong> {$row['speciality']}</p>
                                                <p><strong>Address:</strong><br> {$row['area']}, <br>{$row['city']}, {$row['state']}</p>
                                                <p><strong>Email:</strong> {$row['email']}</p>
                                            </div>
                                            <div style='text-align: center; align-items: center; justify-content: center; line-height: 200px; height: 200px;' class='col-xl-2 col-md-4'>
                                                <a class='btn btn-primary' href='booking-form.php?with={$row['id']}'>Book Now!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bookings.js"></script>

</section>

<?php include "includes/components/footer.php" ?>