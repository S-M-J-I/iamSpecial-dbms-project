<?php $title = "Forums" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>

<!-- Page Content-->
<section class="pt-4" style="text-align: center;">
    <div class="container px-lg-5">
        <div style="text-align: center;" class="row gx-lg-5">
            <h1>Browse the Forum</h1>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!-- Page Features-->
        <div class="row gx-lg-5">
            <?php
            getAllForumCategoriesAsCards()
            ?>
        </div>
        <a class="btn btn-success" href="ask-forum.php">
            <h5>Write a Post</h5>
        </a>
    </div>
</section>
<br>
<!-- Footer-->
<?php include "includes/components/footer.php" ?>