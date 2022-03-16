<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <?php

                $role;
                if (isset($_SESSION["role"])) {
                    $role = $_SESSION["role"];
                } else {
                    $role = "";
                }

                // * Conditional rendering
                switch ($role) {

                    case "counsilor": {
                            include "sidebars/counsilor-sidebar.php";
                            break;
                        }

                    case "user": {
                            include "sidebars/user-sidebar.php";
                        }

                        // * default if ADMIN
                    default: {
                            include "sidebars/admin-sidebar.php";
                            break;
                        }
                }

                ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>