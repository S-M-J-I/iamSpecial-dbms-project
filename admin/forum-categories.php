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
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Forum Category Title</th>
                                    </tr>
                                </thead>
                                <tbody><?php getAllForumCategories();
                                        delete_forum_category(); ?>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <hr>
                        <br>
                        <h4> Add Forum Category </h4>
                        <div class="col-lg-6 card-body">

                            <!-- Add Category form -->
                            <form action="forum-categories.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cat_title">Forum Category Name:</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name">
                                </div>
                                <br>
                                <div style="text-align: right;" class="input-group-prepend">
                                    <input class="btn btn-primary" type="submit" name="add" value="Add Forum Category +">
                                </div>
                            </form>
                            <?php insert_forum_category(); ?>
                        </div>
                        <br>
                        <hr>
                        <br>






                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
    <?php include "includes/components/footer.php" ?>