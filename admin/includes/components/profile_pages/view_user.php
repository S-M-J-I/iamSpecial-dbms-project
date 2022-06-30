<?php

$row = getUserDetailsByID($_SESSION["id"]);

?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $row["first_name"] . " " . $row["last_name"] ?></h1>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row gx-lg-5">
                    <div class="col-lg-3">
                        <div class="card border-0 h-100">
                            <div class="container px-lg-5">
                                <img src="../images/avatars/<?php echo $row['avatar'] ?>?1234324" width="300px" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card border-0 h-100">
                            <div class="container px-lg-12">
                                <h5> <strong>Username:</strong> <?php echo $row["username"] ?></h5>
                                <br>
                                <h5> <strong>Email:</strong> <?php echo $row["email"] ?></h5>
                                <br>
                                <h5> <strong>Phone:</strong> <?php echo $row["phone"] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>