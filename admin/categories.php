<?php include "includes/components/header.php" ?>

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


                        <div class="col-lg-12">

                            <!-- Add Category form -->
                            <form action="categories.php" method="POST">
                                <div class="form-group">
                                    <label for="cat_title">Add Category:</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name">
                                </div>
                                <br>
                                <div class="input-group-prepend">
                                    <input class="btn btn-primary" type="submit" name="add" value="+ Add Category">
                                </div>
                            </form>
                            <?php insert_category(); ?>

                            <br>
                            <hr>
                            <br>
                        </div>






                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
    <?php include "includes/components/footer.php" ?>