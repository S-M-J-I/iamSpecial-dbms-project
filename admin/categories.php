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
                        <?php
                        // TODO: COMPLETE THE CATEGORIES PAGE

                        if (isset($_GET["action"])) {
                            include "includes/components/general_components/edit-category.php";
                            return;
                        }

                        ?>

                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody><?php getAllCategories();
                                        delete_category(); ?>
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <hr>
                        <br>
                        <h4> Add Category</h4>
                        <div class="col-lg-6 card-body">

                            <!-- Add Category form -->
                            <form action="categories.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="cat_title">Category Name:</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="cat_description">Category Description:</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="description">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="cat_thumbnail">Category Thumbnail:</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="file" name="thumbnail">
                                </div>
                                <br>
                                <div style="text-align: right;" class="input-group-prepend">
                                    <input class="btn btn-primary" type="submit" name="add" value="Add Category +">
                                </div>
                            </form>
                            <?php insert_category(); ?>
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