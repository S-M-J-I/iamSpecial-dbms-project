<?php

$booker = getUserDetailsByID($_GET["confirmWith"]);


if (isset($_POST["submit"])) {
    bookAppointment();
}

?>

<div class="col-xs-6">
    <form action="counselor-bookings.php?confirmWith=<?php echo $_GET["confirmWith"] ?>" method="POST" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="form-group row">
                <label for="booker" class="col-sm-2 col-form-label"><strong>Booker</strong></label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $booker["first_name"] . " " . $booker["last_name"] ?>" readonly class="form-control-plaintext" id="booker" value="email@example.com">
                    <input name="booker" type="text" style="display: none;" value="<?php echo $_GET["confirmWith"] ?>">
                    <input name="booked_to" type="text" style="display: none;" value="<?php echo $_SESSION["id"] ?>">
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="booker" class="col-sm-2 col-form-label"><strong>Booker Type</strong></label>
                <div class="col-sm-10">
                    <input name="booker_type" type="text" value="<?php echo "User" ?>" readonly class="form-control-plaintext" id="booker" value="email@example.com">
                </div>
            </div>
            <br>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <strong>Set Date</strong> </span>
                </div>
                <input name="date" class="form-control" type="date">
            </div>
            <br>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <strong>Set Time</strong> </span>
                </div>
                <input name="time" class="form-control" type="time">
            </div>
            <br>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <strong>Agenda</strong> </span>
                </div>
                <textarea name="agenda" cols="100" rows="10"></textarea>
            </div>
            <br>
            <br>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary btn-block"> Confirm Appointment </button>
            </div>
        </div>
    </form>
</div>