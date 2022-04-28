<?php $title = "Sign Up" ?>
<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-repeat: no-repeat; background-image: url('images/resources/log-in.png');">
    <div class="container-fluid">
        <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
            <div class="col-12 col-md-4 col-lg-3   h-50 ">
                <div class="card shadow">
                    <div class="card-body mx-auto">
                        <h4 class="card-title mt-3 text-center">Create Account</h4>
                        <hr>
                        <form action="signup.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input name="first_name" class="form-control" placeholder="First name" type="text">
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input name="last_name" class="form-control" placeholder="Last name" type="text">
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input name="username" class="form-control" placeholder="Username" type="text">
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <select name="role">
                                    <option selected disabled>Registering as</option>
                                    <option value="2">Counselor</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                </div>
                                <input name="email" class="form-control" placeholder="Email address" type="email">
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input name="password" class="form-control" placeholder="Create password" type="password">
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input name="repeat_password" class="form-control" placeholder="Repeat password" type="password">
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-image"></i> </span>
                                </div>
                                <input name="avatar" class="form-control" placeholder="Choose File" type="file">
                            </div>
                            <br>
                            <div class="form-group">
                                <button style="background-color: #43DBAD;border:none;border-radius:30px;font-size:1.1rem;padding:10px;" name="submit" type="submit" class="btn btn-primary btn-block"> <strong>Create Account</strong> </button>
                            </div>
                            <br>
                            <p class="text-center">Have an account?
                                <br>
                                <a href="login.php">Log In</a>
                            </p>
                        </form>
                        <?php signUp() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "includes/components/footer.php" ?>