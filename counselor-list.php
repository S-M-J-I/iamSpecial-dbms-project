<?php $title = "Blogs" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>

<?php

function getView($row)
{
    if (isset($_SESSION["id"])) {
        return "<a class='btn btn-primary' href='booking-form.php?with={$row['id']}'>Book Now!</a>";
    }
}


?>

<section style="margin: 5%;" class="pt-4">
    <br>
    <br>
    <div class="row">
        <?php

        $sql = "SELECT DISTINCT * FROM users WHERE role=2 AND verified='T'";


        $res = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo "
                    <div class='card bg-light'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-xl-3 col-md-6'>
                                    <img src='images/avatars/{$row['avatar']}?1234324' width=250px/>
                                </div>
                                <div class='col-xl-6 col-md-4'>
                                    <p><h4><strong>Dr. {$row['first_name']} {$row['last_name']}</strong></h4></p>
                                    <p><strong>Specialities:</strong> {$row['speciality']}</p>
                                    <p><strong>Address:</strong><br> {$row['area']}, <br>{$row['city']}, {$row['state']}</p>
                                    <p><strong>Email:</strong> {$row['email']}</p>
                                </div>
                                <div style='text-align: center; align-items: center; justify-content: center; line-height: 200px; height: 200px;' class='col-xl-2 col-md-4'>
                                    " .

                    getView($row)

                    . "
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