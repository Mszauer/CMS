
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
                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $queryResult = mysqli_query($connection,$query);
                        if(!$queryResult){
                            die("Query Failed: " . mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($queryResult);
                        if ($count == 0){
                            echo "<h1> No Result found</h1>";
                        }
                        else{
                            while($row = mysqli_fetch_assoc($queryResult)){
                                $postTitle =    $row['post_title'];
                                $postAuthor =   $row['post_author'];
                                $postDate =     $row['post_date'];
                                $postImage =    $row['post_image'];
                                $postContent =  $row['post_content'];
                                ?>
                                                 
                                <h1 class="page-header">
                                    Page Heading
                                    <small>Secondary Text</small>
                                </h1>
                                <!-- First Blog Post -->
                                <h2>
                                    <a href="#"><?php echo "{$postTitle}" ?></a>
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
                        }
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