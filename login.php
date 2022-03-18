<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(https://images.unsplash.com/photo-1477346611705-65d1883cee1e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1920&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=c0d43804e2c7c93143fe8ff65398c8e9);">
    <div class="container-fluid">
        <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
            <div class="col-12 col-md-4 col-lg-3   h-50 ">
                <div class="card shadow">
                    <div class="card-body mx-auto">
                        <h4 class="card-title mt-3 text-center">Log In</h4>
                        <p class="text-center">Get started with your free account</p>
                        <p>
                            <a href="" class="btn btn-block btn-info">
                                <i class="fab fa-twitter mr-2"></i> Login via Twitter</a>
                            <a href="" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook-f mr-2"></i> Login via facebook</a>
                        </p>
                        <p class="text-muted font-weight-bold ">
                            <span>OR</span>
                        </p>
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
                            <div class="form-group">
                                <button name="login" type="submit" class="btn btn-primary btn-block"> <strong>Log In</strong> </button>
                            </div>
                            <br>
                            <p class="text-center">Don't have an account?
                                <a href="signup.php">Sign Up</a>
                            </p>
                            <?php loginUser() ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "includes/components/footer.php" ?>