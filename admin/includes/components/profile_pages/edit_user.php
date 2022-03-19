<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit my profile</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <form action="profile.php?target=edit_profile" method="POST">
                    <div class="col-lg-12">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="username" class="form-control" placeholder="Edit username" type="text">
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="password" class="form-control" placeholder="Edit password" type="text">
                        </div>
                        <div class="form-group">
                            <button name="edit" type="submit" class="btn btn-primary btn-block"> Edit </button>
                        </div>
                    </div>
                </form>
                <?php editUser() ?>
            </div>
        </div>
    </div>
</main>