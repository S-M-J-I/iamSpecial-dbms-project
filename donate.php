<?php $title = "Donate" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>

<?php

if (!isset($_SESSION["id"])) {
    $_SESSION["id"] = -1;
}

?>

<!-- Page Content-->
<section class="pt-4">
    <div class="container px-lg-5">
        <h1>Donations</h1>
        <br>
        <hr>
        <br>
        <!-- Page Features-->
        <?php

        $fundraisers = getDonations();

        while ($row = mysqli_fetch_assoc($fundraisers)) {
            echo "
            <div class='card bg-light'>
                <div class='card-body'>
                    <div class='row'>
                        <div class='col-xl-6 col-md-4'>
                            <p><h4><strong>{$row['title']}</strong></h4></p>
                            <hr>
                            <p><strong>Target: </strong>" . number_format($row['total_target']) . " BDT</p>
                            <p><strong>Raised: </strong>" . number_format(getSumOfDonations($row['id'])) . " BDT</p>
                            <p><strong>Duration:</strong> {$row['duration']}</p>
                        </div>
                        <div style='text-align: center; align-items: center; justify-content: center; line-height: 200px; height: 200px;' class='col-xl-6 col-md-4'>
                            <a class='btn btn-primary' href='payment/example_hosted.php?title={$row['title']}&fund_id={$row['id']}'>Donate!</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <br>
            ";
        }
        ?>

    </div>
</section>
<!-- Footer-->
<?php include "includes/components/footer.php" ?>