<?php $title = "Home" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>

<!-- Page Content-->
<section class="pt-4">
    <div class="container px-lg-5">
        <div style="text-align: center;" class="row gx-lg-5">
            <h1>Select the category you want to browse</h1>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!-- Page Features-->
        <div class="row gx-lg-5">
            <?php

            getAllCategoriesAsList()

            ?>
        </div>
    </div>
</section>
<!-- Footer-->
<?php include "includes/components/footer.php" ?>