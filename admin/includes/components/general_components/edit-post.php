<?php

$blog = getPostByID($_GET["id"]);

?>
<h1 class="mt-4">Edit My Blog Post</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">Edit my post</li>
</ol>
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">

                <div class="col-xs-6">
                    <form action="posts.php?id=<?= $blog["id"] ?>&action=edit" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-6">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <strong>Set Title</strong> </span>
                                </div>
                                <input name="title" class="form-control" value="<?= $blog["title"] ?>" placeholder="Set blog title" type="text">
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <strong>Set Category</strong> </span>
                                </div>
                                <select name="category">
                                    <option value="" default>Choose Category</option>
                                    <?php

                                    getAllCategoriesAsOptions()

                                    ?>
                                </select>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <strong>Content</strong> </span>
                                </div>
                                <textarea class="form-control" cols="40" id="body" rows="10" type="text" name="content" placeholder="Write your post content here">
                                    <?= $blog["content"] ?>
                                </textarea>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <strong>Set Blog Tags</strong> </span>
                                </div>
                                <input name="tags" value="<?= $blog["tags"] ?>" class="form-control" placeholder="Set blog tags (seperated by spaces)" type="text">
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div>
                                <img width="300px" src="../images/blogs/<?= $blog["image"] ?>?123456321">
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <strong>Choose Blog Image</strong> </span>
                                    </div>
                                    <input name="image" value="<?= $blog["image"] ?>" class="form-control" placeholder="Change Photo" type="file">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button name="edit" type="submit" class="btn btn-primary btn-block"> Edit Blog </button>
                            </div>
                        </div>
                    </form>
                    <?php editBlogPost($_GET["id"]) ?>
                </div>

            </div>
        </div>
    </div>
</div>