<h1 class="mt-4">View All Blog Posts</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
    <li class="breadcrumb-item active">All my posts</li>
</ol>
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Tags</th>
                            <th>Draft</th>
                        </tr>
                    </thead>
                    <tbody><?php getAllBlogPosts($_SESSION["id"]) ?>
                    </tbody>
                </table>
                <br>

                <div style="text-align: right;">
                    <a style="text-align:right; margin-right: 3%;" class="btn btn-primary" href="posts.php?action=add"><i class="fas fa-solid fa-plus"></i> Add Post </a>
                </div>


            </div>
        </div>
    </div>
</div>