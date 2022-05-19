<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <?php

        if (isset($_GET["id"])) {
            include "includes/components/profile_pages/view_user.php";
        } else if ($_SESSION["role"] == 2) {
            include "includes/components/profile_pages/view_counselor.php";
        } else {
            include "includes/components/profile_pages/edit_user.php";
        }



        ?>
    </div>
</div>
<?php include "includes/components/footer.php" ?>