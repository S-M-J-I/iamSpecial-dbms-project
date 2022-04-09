<?php include "includes/components/header.php" ?>

<?php

if ($_SESSION["role"] != 1) {
    header("Location: 404.php");
    return;
}

?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <main>

            <div class="card mb-4">

                <div class="card-body">

                    <?php

                    $type;

                    if (isset($_GET["type"])) {
                        $type = $_GET["type"];
                    } else {
                        $type = "";
                    }

                    switch ($type) {
                        case "user": {
                                include "includes/components/admin_components/user_verification.php";
                                break;
                            }
                        case "counselor": {
                                include "includes/components/admin_components/counsilor_verification.php";
                                break;
                            }
                    }


                    // * SEE IF WE (DIS)APPROVED A VERIFICATION REQUEST
                    $status = "";
                    if (isset($_GET["status"])) {
                        $status = $_GET["status"];
                    } else {
                        $status = "";
                    }

                    switch ($status) {
                        case "accept": {
                                $id = $_GET["id"];
                                acceptVerificationRequest($id);
                                break;
                            }
                        case "reject": {
                                $id = $_GET["id"];
                                declineVerificationRequest($id);
                                break;
                            }
                        default: {
                                break;
                            }
                    }


                    ?>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include "includes/components/footer.php" ?>