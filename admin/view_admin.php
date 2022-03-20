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
            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="mt-4">Admit an Admin</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Admit Admin</li>
                            </ol>
                            <div class="card mb-4">
                                <?php

                                $src;

                                if (isset($_GET["target"])) {
                                    $src = $_GET["target"];
                                } else {
                                    $src = "";
                                }

                                switch ($src) {

                                    case "make": {
                                            $usrid = $_GET["id"];
                                            makeAdmin($usrid);
                                            break;
                                        }

                                    default: {
                                            include "includes/components/admin_components/view_all_users.php";
                                            break;
                                        }
                                }

                                ?>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

        </main>
    </div>
</div>
<?php include "includes/components/footer.php" ?>