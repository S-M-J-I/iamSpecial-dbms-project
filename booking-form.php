<?php $title = "Book Now" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php"
?>

<?php

$user = getUserByID($_SESSION["id"]);
$counselor = getUserByID($_GET["with"]);

?>

<section class="pt-4">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Book Appointment</h2>
            <p class="lead">Your appointment with: <strong><?php echo "Dr. " . $counselor["first_name"] . " " . $counselor["last_name"] ?></strong></p>
        </div>
        <?php

        if (isset($_POST["book"])) {
            bookAppointment();
        }


        ?>
        <form action="booking-form.php?with=<?= $_GET["with"] ?>" method="POST" class="needs-validation">
            <div class="row" style="margin: 0 auto;">
                <div class="col-md-8 order-md-1">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstName">Full name</label>
                            <input type="text" name="customer_name" value="<?php echo $_SESSION["id"] == -1 ? "Anonymous" : $user["first_name"] . ' ' . $user["last_name"];  ?>" class="form-control" id="customer_name" placeholder="" value="John Doe" required>
                            <div class="invalid-feedback">
                                Valid customer name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <div class="input-group">
                            <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="Mobile" value="<?php echo $_SESSION["id"] == -1 ? "" : $user["phone"] ?>" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your Mobile number is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" name="customer_email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $_SESSION["id"] == -1 ? "" :  $user["email"] ?>" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="date">Date</label>
                        <input name="date" class="form-control col-lg-3" type="date">
                    </div>

                    <div style="display:table;" class="mb-3">
                        <label style="display: table-cell;" for="time">Preferred starting time slot&nbsp&nbsp</label>

                        <input style="display: table-cell;" name="time" class="form-control col-lg-12" type="time" required>
                        <div class="invalid-feedback">
                            Please enter your start-time.
                        </div>
                        <div class="invalid-feedback">
                            Please enter your start-time.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="agenda">Agenda</label>
                        <textarea name="agenda" class="form-control" cols="30" rows="10"></textarea>
                        <div class="invalid-feedback">
                            Please enter an agenda.
                        </div>
                    </div>

                    <hr class="mb-4">
                    <div style="display: table;text-align:center; margin-left:20%;">
                        <a style="background-color: #43DBAD;border:none;display: table-cell;" class="btn btn-primary btn-lg btn-block col-lg-6" href="chat.php?chatWith=<?= $counselor["id"] ?>">Message</a>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <p style="display: table-cell;">&nbsp;</p>
                        <button name="book" style="background-color: #43DBAD;border:none;display: table-cell;" class="btn btn-primary btn-lg btn-block" type="submit">Request Appointment</button>
                    </div>


        </form>
    </div>
</section>
<?php include "includes/components/footer.php" ?>