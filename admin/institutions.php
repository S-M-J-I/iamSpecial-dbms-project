<?php include "includes/components/header.php" ?>

<?php

if ($_SESSION["role"] != 1) {
    header("Location: 401.php");
    return;
}

?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Our Institutions</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Add Institution</li>
                </ol>
                <div class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php

                            $src;

                            if (isset($_GET["target"])) {
                                $src = $_GET["target"];
                            } else {
                                $src = "";
                            }

                            switch ($src) {

                                    // TODO: Add institution form and delete institution
                                case "add": {
                                        include "includes/components/admin_components/add_institute.php";
                                        break;
                                    }
                                default: {
                                        include "includes/components/admin_components/view_all_institutes.php";
                                        break;
                                    }
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "includes/components/footer.php" ?>