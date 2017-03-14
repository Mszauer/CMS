<?php include 'includes/header.php' ?>
<?php include 'includes/db.php' ?>
    <!-- Navigation -->
    <?php include 'includes/navbar.php' ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                 
                <h1 class="page-header">
                    CMS System
                    <small>by Martin Sz.</small>
                </h1>
    
                <?php 
                    $query = "SELECT * FROM posts";
                    $queryResult = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($queryResult)){
                        $postId =       $row['post_id'];
                        $postTitle =    $row['post_title'];
                        $postAuthor =   $row['post_author'];
                        $postDate =     $row['post_date'];
                        $postImage =    $row['post_image'];
                        $postContent =  substr($row['post_content'],0,100) . "...";
                        $postStatus =   $row['post_status'];
                        if($postStatus == 'published'){
                        ?>
                            <!-- First Blog Post -->
                            <h2>
                                <a href="post.php?p_id=<?php echo $postId ?>"><?php echo "{$postTitle}" ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="author_posts.php?author=<?php echo "{$postAuthor}" ?>&p_id=<?php echo $postId ?>"><?php echo "{$postAuthor}" ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$postDate}" ?></p>
                            <hr>
                            <a href="post.php?p_id=<?php echo $postId ?>">
                                <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                            </a>
                            <hr>
                            <p><?php echo "{$postContent}" ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $postId ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
                        <?php
                        } else{
                            echo "<h1>No published posts yet!</h1>";
                        } //removing this for each unpublished post, ask gabor
                    }
                ?>
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>
            </div>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'includes/footer.php' ?>