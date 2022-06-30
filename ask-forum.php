<?php $title = "Ask" ?>
<?php include "includes/components/header.php" ?>
<!-- Responsive navbar-->
<?php include "includes/components/navbar.php" ?>
<br>
<br>
<?php

global $connection;
if (isset($_POST["ask"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $poster = $_SESSION["id"];
    $category = $_POST["forum_category"];
    $tags = $_POST["tags"];
    $date = date("Y-m-d");

    $sql = "INSERT INTO forums(`title`, `poster`, `content`, `category`, `tags`,`date`) VALUES (?,?,?,?,?,?)";
    $query = $connection->prepare($sql);
    $query->bind_param("sisiss", $title, $poster, $content, $category, $tags, $date);
    $query->execute();

    $sql = "SELECT * FROM forums WHERE poster='$poster' ORDER BY id DESC LIMIT 1";
    $query = mysqli_query($connection, $sql) or die("Failed " . mysqli_error($connection));

    if ($query) {
        $row = mysqli_fetch_assoc($query);
        header("Location: forum-post.php?id=" . $row['id']);
    }
}

?>
<br>
<br>
<div class="row">

    <div style="margin-left: 10%;" class="col-lg-9 card bg-light mb-3">
        <div class="card-body">
            <form action="ask-forum.php" method="POST">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <input name="title" size="50" class="form-control" placeholder="Your post title" type="text">
                    </div>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <textarea name="content" cols="150" rows="10" class="form-control" placeholder="Ask a question" type="text"></textarea>
                    </div>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <select class="form-control" name="forum_category">
                            <option value="">Choose Category</option>
                            <?php
                            getAllForumCategoriesAsOptions()
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <input name="tags" size="50" class="form-control" placeholder="Post tags (seperated by commas)" type="text">
                    </div>
                </div>
                <div class="form-group input-group">
                    <input class="btn btn-success" name="ask" placeholder="Ask a question" type="submit">
                </div>
            </form>
        </div>

    </div>
</div>
<br>