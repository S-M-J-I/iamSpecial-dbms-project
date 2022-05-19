<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <?php
            global $connection;
            if (isset($_GET["action"])) {
                $sql = "UPDATE fundraisers SET approved='T' WHERE id=?";
                $query = $connection->prepare($sql);
                $query->bind_param("i", $_GET["id"]);
                $query->execute();
                header("Location: approve-fundraiser.php");
            }

            ?>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Approve Fundraisers</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Fundraiser</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Total Target</th>
                                    <th>Duration</th>
                                    <th>Requested By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php getAllFundraisersInATable(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
<?php include "includes/components/footer.php" ?>