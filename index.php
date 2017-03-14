<?php include 'includes/header.php' ?>
<?php include 'includes/db.php' ?>
<?php include './admin/functions.php' ?>
<?php ob_start() ?>
<?php session_start() ?>

    <!-- Navigation -->
    <?php include 'includes/navbar.php' ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <!-- Pagination Get -->
                <?php
                $page = "";
                $shown_items = 2;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                } else{
                    $page = "";
                }
                if( $page == "" || $page == 1){
                    $page_1 = 0;
                } else{
                    $page_1 = ($page * $shown_items) - $shown_items;
                }
                ?>
                <h1 class="page-header">
                    CMS System
                    <small>by Martin Sz.</small>
                </h1>
                <!-- Display Posts -->
                <?php 
                    $count_query = "SELECT * FROM posts";
                    $count_result = mysqli_query($connection, $count_query);
                    $count = mysqli_num_rows($count_result);
                    $count = ceil($count / $shown_items);
                    $query = "SELECT * FROM posts LIMIT $page_1, $shown_items";
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
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "{$postDate}"; ?></p>
                            <hr>
                            <a href="post.php?p_id=<?php echo $postId ?>">
                                <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">
                            </a>
                            <hr>
                            <p><?php echo "{$postContent}" ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $postId; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
                        <?php
                        }
                    }
                    // else{
                    //     echo "<h1>No published posts yet!</h1>";
                    // }
                ?>
                <!-- Pagination -->
               <ul class="pager">
                   <?php
                   for($i = 1; $i <= $count; $i++){
                       if($i == $page){
                           echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                       } else{
                           echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                       }
                       
                   }
                   ?>
               </ul>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php' ?>
            </div>
        </div>
        <!-- /.row -->

        <hr>
<?php include 'includes/footer.php' ?>