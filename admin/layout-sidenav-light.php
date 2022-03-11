<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Sidenav Light</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sidenav Light</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        This page is an example of using the light side navigation option. By appending the
                        <code>.sb-sidenav-light</code>
                        class to the
                        <code>.sb-sidenav</code>
                        class, the side navigation will take on a light color scheme. The
                        <code>.sb-sidenav-dark</code>
                        is also available for a darker option.
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<?php include "includes/components/footer.php" ?>