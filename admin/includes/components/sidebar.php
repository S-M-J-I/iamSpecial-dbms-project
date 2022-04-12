<div id="layoutSidenav_nav">
    <?php

    if ($_SESSION["role"] == 2) {
        echo "<nav class='sb-sidenav accordion' style='background-color: #dd4f5d; color: white;' id='sidenavAccordion'>";
    } else if ($_SESSION["role"] == 3) {
        echo "<nav class='sb-sidenav accordion' style='background-color: #2c447e; color: white;' id='sidenavAccordion'>";
    } else {
        echo "<nav class='sb-sidenav accordion sb-sidenav-dark' id='sidenavAccordion'>";
    }
    ?>
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