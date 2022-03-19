<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <?php

        $src;

        if (isset($_GET["target"])) {
            $src = $_GET["target"];
        } else {
            $src = "";
        }

        switch ($src) {
            case "edit_profile": {
                    include "includes/components/profile_pages/edit_user.php";
                    break;
                }

            default: {
                    include "includes/components/profile_pages/view_user.php";
                    break;
                }
        }

        ?>
    </div>
</div>
<?php include "includes/components/footer.php" ?>