<?php $title = "Forums" ?>
<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>

<!-- In-Line styles DO NOT TOUCH -->
<style>
    .icon-1x {
        font-size: 24px !important;
    }

    a {
        text-decoration: none;
    }

    .text-primary,
    a.text-primary:focus,
    a.text-primary:hover {
        color: #00ADBB !important;
    }

    .text-black,
    .text-hover-black:hover {
        color: #000 !important;
    }

    .font-weight-bold {
        font-weight: 700 !important;
    }
</style>


<?php

$forums = getForumPostsByID($_GET["category"]);

?>

<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
<br>
<br>
<div class="container">

    <div class="row">
        <!-- Main content -->


        <br>
        <div class="col-lg-9 mb-3">

            <br>
            <div class="row text-left mb-5">
                <div class="col-lg-6 mb-3 mb-sm-0">
                    <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" style="width: 100%;">
                        <select class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" data-toggle="select" tabindex="-98">
                            <option> Categories </option>
                            <option> Learn </option>
                            <option> Share </option>
                            <option> Build </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <div class="dropdown bootstrap-select form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" style="width: 100%;">
                        <select class="form-control form-control-lg bg-white bg-op-9 ml-auto text-sm w-lg-50" data-toggle="select" tabindex="-98">
                            <option> Filter by </option>
                            <option> Votes </option>
                            <option> Replys </option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- End of post 1 -->
            <?php

            while ($row = mysqli_fetch_assoc($forums)) {
                $user = getUserByID($row['poster']);
                echo "
                    <div class='card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0'>
                        <div class='row align-items-center'>
                            <div class='col-md-8 mb-3 mb-sm-0'>
                                <h5>
                                    <a href='forum-post.php?id={$row['id']}' class='text-primary'>{$row['title']}</a>
                                </h5>
                                <p class='text-sm'><span class='op-6'>Posted</span> " . date('F d, Y', strtotime($row["date"])) . " <span class='op-6'> by</span> <a class='text-black' href='#'>{$user['username']}</a></p>
                                <div class='text-sm op-5'> " . getForumTags($row) . " </div>
                            </div>
                            <div class='col-md-4 op-7'>
                                <div class='row text-center op-7'>
                                    <div class='col px-1'> <i class='ion-connection-bars icon-1x'></i> <span class='d-block text-sm'>{$row["upvotes"]} Upvotes</span> </div>
                                    <div class='col px-1'> <i class='ion-ios-chatboxes-outline icon-1x'></i> <span class='d-block text-sm'>{$row["comments"]} Replys</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }

            ?>
            <!-- /End of post 1 -->
        </div>
        <!-- Sidebar content -->
        <?php include "includes/sidebar.php" ?>
    </div>
</div>


<?php include "includes/components/footer.php" ?>