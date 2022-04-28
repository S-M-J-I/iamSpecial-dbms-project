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

<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
<br>
<br>
<div class="container">
    <div class="row">
        <!-- Main content -->
        <div class="col-lg-9 mb-3">
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
            <?php include "includes/forum-post.php" ?>
            <!-- /End of post 1 -->
        </div>
        <!-- Sidebar content -->
        <?php include "includes/sidebar.php" ?>
    </div>
</div>


<?php include "includes/components/footer.php" ?>