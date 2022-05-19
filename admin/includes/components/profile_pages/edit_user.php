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
                            <h4>
                                <strong>
                                    <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"] ?>
                                </strong>
                            </h4>
                        </div>

                        <div class="col-xs-6">
                            <form action="profile.php" method="POST" enctype="multipart/form-data">
                                <div class="col-lg-6">
                                    <img src="../images/avatars/<?php echo $row['avatar'] ?>?1234324" width="250" alt="">
                                    <br>
                                    <div class="col-lg-5">
                                        <div class="form-group input-group">
                                            <input name="avatar" class="form-control" placeholder="Change Photo" type="file">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <strong>Edit Username</strong> </span>
                                        </div>
                                        <input name="username" class="form-control" value="<?php echo $_SESSION['username'] ?>" placeholder="Edit username" type="text">
                                    </div>
                                    <br>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <strong>Edit Password</strong> </span>
                                        </div>
                                        <input name="password" class="form-control" placeholder="Edit password" type="pasword">
                                    </div>
                                    <br>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <strong>Edit Email</strong> </span>
                                        </div>
                                        <input name="email" class="form-control" value="<?php echo $row['email'] ?>" placeholder="Edit Email" type="email">
                                    </div>
                                    <br>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <strong>Edit Phone</strong> </span>
                                        </div>
                                        <input name="phone" class="form-control" value="<?php echo $row['phone'] ?>" placeholder="Edit Email" type="email">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button name="edit" type="submit" class="btn btn-primary btn-block"> Edit My Profile </button>
                                    </div>
                                </div>
                            </form>
                            <?php editUser() ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>