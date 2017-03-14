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
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <?php
                if(isset($_GET['category'])){
                    $category = $_GET['category'];
                }
                ?>
                <?php 
                    $query = "SELECT * FROM posts WHERE post_category_id = $category";
                    $queryResult = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($queryResult)){
                        $postId =       $row['post_id'];
                        $postTitle =    $row['post_title'];
                        $postAuthor =   $row['post_author'];
                        $postDate =     $row['post_date'];
                        $postImage =    $row['post_image'];
                        $postContent =  substr($row['post_content'],0,100) . "...";
                        
                ?>
                    <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $postId ?>"><?php echo "{$postTitle}" ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo "{$postAuthor}" ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$postDate}" ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                <hr>
                <p><?php echo "{$postContent}" ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                
                <?php
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