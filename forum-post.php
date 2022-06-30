<?php $title = "Post" ?>
<?php include "includes/components/header.php" ?>

<?php include "includes/components/navbar.php" ?>
<?php

$post = getForumPost($_GET["id"]);
$author = getUserByID($post["poster"]);


?>

<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= $post["title"] ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on <?= date('F d, Y', strtotime($post["date"])); ?> by <strong><?= $author["first_name"] . " " . $author["last_name"] ?></strong></div>
                    <!-- Post categories-->
                    <?php

                    $tags = explode(",", $post["tags"]);
                    foreach ($tags as $key => $value) {
                        echo "<p class='badge bg-secondary text-decoration-none link-light'>$value</p> ";
                    }
                    ?>

                </header>
                <!-- Post content-->
                <section class="mb-5">
                    <hr>
                    <p class="fs-5 mb-4"><?= $post["content"] ?></p>
                </section>

                <?php

                $p = $_GET["id"];

                if (isset($_SESSION["id"])) {
                    $user = $_SESSION["id"];
                }


                $sql = "SELECT * FROM forum_upvotes WHERE post='$p' AND upvoted_by='$user'";
                $query = mysqli_query($connection, $sql);

                if (mysqli_num_rows($query) < 1) {
                    echo "
                    <div style='text-align:right;'>
                        <p>
                            <strong>{$post['upvotes']} Upvotes: </strong>
                            <strong><a style='text-decoration: none; ' href='forum-post.php?id={$post['id']}&action=upvote'>Upvote ❤️</a></strong>
                        </p>

                    </div>
                    ";
                } else {
                    echo "
                    <div style='text-align:right;'>
                        <p>
                            <strong>{$post['upvotes']} Upvotes: </strong>
                            <strong>Upvoted ❤️</strong>
                        </p>

                    </div>
                    ";
                }

                ?>
                <br>
                <br>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <?php
                        global $connection;
                        if (isset($_GET["action"])) {

                            $post = $_GET["id"];
                            $user = $_SESSION["id"];

                            $sql = "SELECT * FROM forum_upvotes WHERE post=$post AND upvoted_by='$user'";
                            $query = mysqli_query($connection, $sql);

                            if (mysqli_num_rows($query) < 1) {
                            }

                            $sql = "INSERT INTO forum_upvotes(`post`, `upvoted_by`) VALUES(?,?)";
                            $query = $connection->prepare($sql);
                            $query->bind_param("ii", $post, $user);
                            $query->execute();

                            $sql = "UPDATE forums SET upvotes=(SELECT COUNT(*) FROM forum_upvotes WHERE post='$post') WHERE id='$post'";
                            $query = mysqli_query($connection, $sql);

                            header("Location: forum-post.php?id=" . $_GET["id"]);
                        }

                        if (isset($_SESSION["id"])) {
                            echo "
                            <form action='forum-post.php?id={$post['id']}' method='POST' class='mb-4'>
                                <textarea name='content' class='form-control' rows='3' placeholder='Leave a comment!'></textarea>
                                <br>
                                <input id='btn' name='comment' type='submit' class='btn btn-primary' value='Post Comment'>
                            </form>
                            ";
                        } else {
                            echo "
                            <a href='login.php'>Login</a> to post a comment!<br>
                            <br>
                            ";
                        }

                        ?>
                        <hr>
                        <br>
                        <div class="comment-area">
                            <?php
                            global $connection;
                            if (isset($_POST["comment"])) {
                                $commenter = $_SESSION["id"];
                                $commented_to = $_GET["id"];
                                $content = $_POST["content"];
                                $date = date("Y-m-d");

                                $sql = "INSERT INTO forum_comments(`commenter`, `commented_to`, `content`, `date`) VALUES(?,?,?,?)";
                                $query = $connection->prepare($sql);
                                $query->bind_param("iiss", $commenter, $commented_to, $content, $date);
                                $query->execute();

                                $sql = "UPDATE forums SET comments=(SELECT COUNT(*) FROM forum_comments WHERE commented_to='$commented_to') WHERE id='$commented_to'";
                                $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

                                header("Location: forum-post.php?id=$commented_to");
                            }

                            $comments = getAllCommentsByForumPostID($_GET["id"]);

                            while ($row = mysqli_fetch_assoc($comments)) {
                                $user = getUserByID($row['commenter']);

                                if ($user["role"] == 2) {
                                    echo "
                                    <div class='d-flex'>
                                        <div class='flex-shrink-0'><img width='50px' class='rounded-circle' src='images/avatars/{$user['avatar']}' alt='...' /></div>
                                        <div class='ms-3'>
                                            <div class='fw-bold'>{$user['username']} - <i>Counselor</i></div>
                                            {$row['content']}
                                        </div>
                                    </div>
                                    <hr>
                                    ";
                                } else {
                                    echo "
                                    <div class='d-flex'>
                                        <div class='flex-shrink-0'><img width='50px' class='rounded-circle' src='images/avatars/{$user['avatar']}' alt='...' /></div>
                                        <div class='ms-3'>
                                            <div class='fw-bold'>{$user['username']}</div>
                                            {$row['content']}
                                            <div>
                                                <a class='reply' style='color: blue; cursor: pointer;'>Reply</a>
                                                <form class='reply-form' action='forum-post.php?id={$post['id']}' method='POST' style='display: none;'>
                                                    <textarea name='content' class='form-control' rows='3' placeholder='Leave a reply!'></textarea>
                                                    <input name='comment' type='submit' class='btn btn-primary' value='Post Comment'>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    ";
                                }
                            }

                            ?>
                        </div>
                        <!-- Comment with nested comments-->
                        <!-- <div class="d-flex mb-4">


                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                <div>
                                    <a class="reply" style="color: blue; cursor: pointer;">Reply</a>
                                    <form id='reply-form' action="post.php?blog=" <?= $blog["id"] ?> method="POST" style="display: none;">
                                        <textarea name='content' class='form-control' rows='3' placeholder='Leave a reply!'></textarea>
                                        <input id='btn' name='comment' type='submit' class='btn btn-primary' value='Post Comment'>
                                    </form>
                                </div>


                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets -->
        <div class="col-lg-4">
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Posts Like This</div>
                <div class="card-body">
                    <div class="row">
                        <?php

                        $others = getForumPostsLikeThese($post["tags"], $post['id'])

                        ?>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <?php

                                $i = 1;
                                while ($row = mysqli_fetch_assoc($others)) {
                                    if ($i === 3) {
                                        break;
                                    }
                                    echo "<li><a href='forum-post.php?id={$row['id']}'>{$row['title']}</a></li>";
                                }

                                ?>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <?php

                                $i = 1;
                                while ($row = mysqli_fetch_assoc($others)) {
                                    if ($i === 3) {
                                        break;
                                    }
                                    echo "<li><a href='forum-post.php?id={$row['id']}'>{$row['title']}</a></li>";
                                }

                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<script src="js/reply.js"></script>
<?php include "includes/components/footer.php" ?>