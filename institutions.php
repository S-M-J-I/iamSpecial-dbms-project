<?php $title = "Blogs" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>

<section style="margin: 5%;" class="pt-4">
    <div class="row">
        <form class='form-inline'>

        </form>
    </div>
    <br>
    <br>
    <div class="row">
        <?php

        $sql = "SELECT DISTINCT * FROM institutions";


        $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

        echo "<h3>Showing " . mysqli_num_rows($res) . " results:</h3>
        <hr>
        <br>";

        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo "
                    <div class='card bg-light'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-xl-3 col-md-6'>
                                    <img src='images/institutions/{$row['picture']}?1234324' width=250px/>
                                </div>
                                <div class='col-xl-6 col-md-4'>
                                    <p><h4><strong> {$row['name']} </strong></h4></p>
                                    <p>{$row['about']}</p>
                                    <p><strong>Address:</strong><br> {$row['area']}, <br>{$row['city']}, {$row['state']}</p>
                                    <p><strong>Phone:</strong> {$row['phone']}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    ";
            }
        }
        ?>
    </div>
</section>

<?php include "includes/components/footer.php" ?>