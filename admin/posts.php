<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <?php

                if (isset($_GET["action"])) {
                    $action = $_GET["action"];
                } else {
                    $action = "";
                }

                switch ($action) {
                    case "add": {
                            include "includes/components/general_components/add-post.php";
                            break;
                        }
                    case "approve": {
                            approvePost($_GET["id"]);
                            break;
                        }
                    case "edit": {
                            include "includes/components/general_components/edit-post.php";
                            break;
                        }
                    case "delete": {
                            deleteBlogPost($_GET["id"]);
                            break;
                        }
                    default: {
                            include "includes/components/general_components/view-post.php";
                            break;
                        }
                }


                ?>

            </div>
        </main>
    </div>
</div>
</div>
<?php include "includes/components/footer.php" ?>