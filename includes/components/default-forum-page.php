<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">

<div style="text-align: center;" class="row gx-lg-5">
    <?php
    getAllSelectiveForumCategoriesAsCards()
    ?>
    <h5 tyle="text-align: right;"><a href="forum-lists.php?type=view-all">See All >></a></h5>
</div>
<br>
<br>
<div style="text-align: center;">
    <a style="text-align: center;" class="btn btn-success" href="ask-forum.php">
        <h5>Write a Post</h5>
    </a>
</div>

<br>
<br>
<br>
<hr>
<br>
<h1 style="text-align: center;">Popular Topics</h1>
<br>
<div class="row gx-lg-5">
    <?php

    $forums = getPopularForumTopics();

    while ($row = mysqli_fetch_assoc($forums)) {
        $user = getUserByID($row['poster']);
        echo "
            <div class='card row-hover pos-relative py-3 px-3 mb-3 border-warning border-top-0 border-right-0 border-bottom-0 rounded-0'>
                <div class='row align-items-center'>
                    <div class='col-md-8 mb-3 mb-sm-0'>
                        <h5>
                            <a href='forum-post.php?post={$row['id']}' class='text-primary'>{$row['title']}</a>
                        </h5>
                        <p class='text-sm'><span class='op-6'>Posted</span> " . date('F d, Y', strtotime($row["date"])) . " <span class='op-6'> by</span> <a class='text-black' href='#'>{$user['username']}</a></p>
                        <div class='text-sm op-5'> " . getForumTags($row) . " </div>
                    </div>
                    <div class='col-md-4 op-7'>
                        <div class='row text-center op-7'>
                            <div class='col px-1'> <i class='ion-connection-bars icon-2x'></i> <span class='d-block text-sm'>{$row['upvotes']} Upvotes</span> </div>
                            <div class='col px-1'> <i class='ion-ios-chatboxes-outline icon-2x'></i> <span class='d-block text-sm'>{$row['comments']}  Replys</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }
    ?>
</div>