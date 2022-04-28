<?php
$title = "Log In";
include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-repeat: no-repeat; background-image: url('images/resources/log-in.png');">
    <div class="container-fluid">
        <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
            <div class="col-12 col-md-4 col-lg-3   h-50 ">
                <div class="card shadow">
                    <div class="card-body mx-auto">
                        <br>
                        <br>
                        <h2 class="card-title mt-3 text-center"><strong>Login</strong></h2>
                        <br>
                        <br>
                        <form action="login.php" method="POST">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                </div>
                                <input name="username" class="form-control" placeholder="Enter username" type="text">
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input name="password" class="form-control" placeholder="Enter password" type="password">
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <button style="background-color: #43DBAD;border:none;border-radius:30px;font-size:1.2rem;padding:10px;" name="login" type="submit" class="btn btn-primary btn-block"> <strong>Log In</strong> </button>
                            </div>
                            <br>
                            <br>
                            <br>
                            <p class="text-center">Don't have an account?
                                <br>
                                <a href="signup.php">Sign Up</a>
                            </p>
                            <?php loginUser() ?>
                            <br>
                            <br>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "includes/components/footer.php" ?>