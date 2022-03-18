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
                    case 1: {
                            include "sidebars/admin-sidebar.php";
                            break;
                        }

                    case 2: {
                            include "sidebars/counsilor-sidebar.php";
                            break;
                        }

                    case 3: {
                            include "sidebars/user-sidebar.php";
                            break;
                        }
                }

                ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Welcome <strong><?php echo strtoupper($_SESSION["first_name"]) ?></strong></div>

        </div>
    </nav>
</div>