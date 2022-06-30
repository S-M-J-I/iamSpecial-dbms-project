<?php $title = "Blogs" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>

<?php

$category = getCategoryByID($_GET["category"]);
$blogs = getBlogsByCategory($_GET["category"]);


?>

<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <div>
                <h1 class="fw-bolder"><?= $category["name"] ?>!</h1>
                <p class="lead mb-0"><?= $category["description"] ?></p>
            </div>
        </div>
    </div>
</header>


<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-12">
            <!-- Featured blog post-->
            <!-- <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">January 1, 2021</div>
                    <h2 class="card-title">Featured Post Title</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a class="btn btn-primary" href="#!">Read more →</a>
                </div>
            </div> -->
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <?php

                while ($row = mysqli_fetch_assoc($blogs)) {
                    echo "
                    <div class='col-lg-4'>
                        <div class='card mb-4' height='300px'>
                            <a href='post.php?blog={$row['id']}'><img  class='card-img-top' src='images/blogs/{$row['image']}' alt='...' /></a>
                            <div class='card-body'>
                                <div class='small text-muted'>" . date('F d, Y', strtotime($row["date"])) . "</div>
                                <h2 class='card-title h4'>{$row['title']}</h2>
                                <br>
                                <br>
                                <a class='btn btn-primary' href='post.php?blog={$row['id']}'>Read more → </a>
                            </div>
                        </div>
                    </div>
                    ";
                }


                ?>

            </div>
        </div>
    </div>
</div>
<br>
<br>
</div>
<?php include "includes/components/footer.php" ?>