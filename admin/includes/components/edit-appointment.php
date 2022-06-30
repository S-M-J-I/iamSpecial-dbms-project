<?php

$booking = getBookingByID($_GET["edit"]);

if (isset($_POST["edit"])) {
    editBookingByID($_GET["edit"]);
}


?>

<div class="col-xs-6">
    <form action="requested-bookings.php?edit=<?= $_GET["edit"] ?>" method="POST" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <strong>Set Time</strong> </span>
                </div>
                <input name="time" class="form-control" type="time">
            </div>
            <br>
            <div class="form-group">
                <button name="edit" type="submit" class="btn btn-primary btn-block"> Edit Appointment </button>
            </div>
        </div>
    </form>
</div>