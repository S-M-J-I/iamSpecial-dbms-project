<?php $title = "Forums" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>

<!-- Page Content-->
<section class="pt-4">
    <div class="container px-lg-5">
        <div class="row gx-lg-5">
            <h1 style="text-align: center;">Browse the Forum</h1>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!-- Page Features-->
        <?php


        if (isset($_GET["type"])) {
            $type = $_GET["type"];
        } else {
            $type = "";
        }

        switch ($type) {
            case "view-all": {
                    include "includes/components/view-all-forums.php";
                    break;
                }
            default: {
                    include "includes/components/default-forum-page.php";
                    break;
                }
        }

        ?>

    </div>
</section>
<br>
<!-- Footer-->
<?php include "includes/components/footer.php" ?>