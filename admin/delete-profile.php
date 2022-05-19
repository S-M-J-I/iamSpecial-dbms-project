<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<div id="layoutSidenav">
    <?php include "includes/components/sidebar.php" ?>
    <div id="layoutSidenav_content">
        <div style="text-align: center;" class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <h1>Are you sure you want to delete your profile?</h1>
                        <h6><i>This action is irreversible and you will have to sign up again in order to avail the benefits of iamspecial.com</i></h6>

                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <form action="delete-profile.php" method="POST">
                            <div class="form-group">
                                <button name="delete" type="submit" class="btn btn-danger"> Delete My Profile </button>
                            </div>
                        </form>
                    </div>
                    <?php deleteUser() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/components/footer.php" ?>