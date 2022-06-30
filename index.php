<?php $title = "Home" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php"
?>
<!-- Header-->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div style="text-align:center; background-color:#f2f3f4;" class="carousel-item active w-100">
            <img style="object-fit: fill;" src="images/resources/4.jpg?1213123" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h3>Welcome to iamspecial.com</h3>
            </div>
        </div>
        <div style="text-align:center; background-color:#f2f3f4;" class="carousel-item w-100">
            <a href="bookings.php" style="text-decoration: none;">
                <img style="object-fit: fill;" src="images/resources/7.png?123123" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Find the Best Counselors</h3>
                </div>
            </a>
        </div>
        <div style="text-align:center; background-color:#f2f3f4;" class="carousel-item w-100">
            <a href="institutions.php" style="text-decoration: none;">
                <img style="object-fit: fill;" src="images/resources/5.jpg?12321312" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Find the Best Institutions</h3>
                </div>
            </a>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<br>
<br>
<br>
<!-- Page Content-->
<section class="pt-4">
    <div class="container px-lg-6">
        <!-- Page Features-->
        <div class="row gx-lg-5">
            <div class="col-lg-6 col-xxl-4 mb-5">
                <a style="text-decoration: none;" href="forum-lists.php">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <i style="color: #43DBAD;" class="fa-solid fa-people-group fa-10x"></i>
                        <br>
                        <br>
                        <h4 style="color: black;">Find help in Our Forums</h4>
                    </div>
                </a>

            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                    <a style="text-decoration: none;" href="blog-lists.php">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <i style="color: #43DBAD;" class="fas fa-comment fa-10x"></i>
                            <br>
                            <br>
                            <h4 style="color: black;">The Right Info from Our Blogs</h4>
                        </div>
                    </a>
                </div>

            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                    <a style="text-decoration: none;" href="counselor-list.php">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <i style="color: #43DBAD;" class="fa-solid fa-user-doctor fa-10x"></i>
                            <br>
                            <br>
                            <h4 style="color: black;">Find the Right Counselors</h4>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<?php include "includes/components/footer.php" ?>