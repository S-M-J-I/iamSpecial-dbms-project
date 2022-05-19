<?php $cat = getCategoryByID($_GET["id"]) ?>
<h4> Edit Category</h4>
<div class="col-lg-6 card-body">

    <!-- Add Category form -->
    <form action="categories.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="cat_title">Category Name:</label>
        </div>
        <div class="form-group">
            <input class="form-control" value="<?= $cat["name"] ?>" type="text" name="name">
        </div>
        <br>
        <div class="form-group">
            <label for="cat_description">Category Description:</label>
        </div>
        <div class="form-group">
            <input class="form-control" value="<?= $cat["description"] ?>" type="text" name="description">
        </div>
        <br>
        <div class="form-group">
            <label for="cat_thumbnail">Category Thumbnail:</label>
        </div>
        <div class="form-group">
            <input class="form-control" type="file" name="thumbnail">
        </div>
        <br>
        <div style="text-align: right;" class="input-group-prepend">
            <input class="btn btn-primary" type="submit" name="edit" value="Edit Category">
        </div>
    </form>
    <?php edit_category(); ?>
</div>