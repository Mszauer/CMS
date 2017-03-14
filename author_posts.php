<?php session_start(); ?>
<?php include './admin/functions.php' ?>
<?php include 'includes/header.php' ?>
<?php include 'includes/db.php' ?>
    <!-- Navigation -->
    <?php include 'includes/navbar.php' ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                
                if(isset($_GET['p_id'])){
                     $post_id = $_GET['p_id'];
                     $post_author = $_GET['author'];
                }
                
                ?>
                <?php 
                    $query = "SELECT * FROM posts WHERE post_author = '{$post_author}' ";
                    $queryResult = mysqli_query($connection,$query);
                    if (!$queryResult){
                        die("Author Query Failed: ") . mysqli_error($queryResults);
                    }
                    while($row = mysqli_fetch_assoc($queryResult)){
                        $postTitle =    $row['post_title'];
                        $postAuthor =   $row['post_author'];
                        $postDate =     $row['post_date'];
                        $postImage =    $row['post_image'];
                        $postContent =  $row['post_content'];
                        
                ?>
                    <!-- First Blog Post -->
                <h2>
                    <a href="#" class="page-header"><?php echo "{$postTitle}" ?></a>
                </h2>
                <p class="lead">
                    All posts by <?php echo "{$postAuthor}" ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$postDate}" ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                <hr>
                <p><?php echo "{$postContent}" ?></p>
                <hr>
                
                <?php
                    }
                ?>
                <hr>
            </div>
            <?php include 'includes/sidebar.php' ?>
            </div>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'includes/footer.php' ?>