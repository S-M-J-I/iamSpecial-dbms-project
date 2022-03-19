<?php

$row = getUserDetailsByID($_SESSION["id"]);

?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">My Profile</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">

                        <?php
                        // TODO: Change the 2-column UI format  
                        ?>

                        <div class="col-xs-6">
                            <img src="../images/avatars/<?php echo $row['avatar'] ?>" width="300" alt="">
                        </div>

                        <div class="col-xs-6">
                            <h3><strong>Name:</strong> <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h3>
                            <h3><strong>Username:</strong> <?php echo $_SESSION['username'] ?></h3>
                            <h3><strong>Email:</strong> <?php echo $row['email'] ?></h3>
                            <h3><strong>Role:</strong> <?php echo getRoleByID($_SESSION['role']) ?></h3>
                            <div class="row">
                                <div class="form-group">
                                    <a class="btn btn-primary" href="profile.php?target=edit_profile">Update</a>
                                </div>
                                <br>
                                <div class="form-group">
                                    <a class="btn btn-danger" href="profile.php?target=delete_profile">Delete</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>