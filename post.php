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
            <?php
            
            if(isset($_GET['p_id'])){
                 $post_id = $_GET['p_id'];
            }
            
            ?>
            <?php 
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $queryResult = mysqli_query($connection,$query);
                if (!$queryResult){
                    die("Query Failed: ") . mysqli_error($queryResults);
                }
                while($row = mysqli_fetch_assoc($queryResult)){
                    $postTitle =    $row['post_title'];
                    $postAuthor =   $row['post_author'];
                    $postDate =     $row['post_date'];
                    $postImage =    $row['post_image'];
                    $postContent =  $row['post_content'];
                    
            ?>
                <!-- Blog Post -->
            <h2>
                <a href="#" class="page-header"><?php echo "{$postTitle}" ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo "{$postAuthor}" ?></a>
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
           
           <!-- Blog Comments -->
            
            <?php
            if(isset($_POST['create_comment'])){
                $post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_content= $_POST['comment_content'];
                $query = "INSERT INTO comments (comment_post_id, comment_date, comment_author, comment_content, comment_status) VALUES ($post_id, now(), '{$comment_author}', '{$comment_content}', 'Unapproved')";
                $queryResult = mysqli_query($connection,$query);
                if (!$queryResult){
                    die("Query Failed: ") . mysqli_error($connection);
                }
                $comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count+1 WHERE post_id = $post_id";
                $ccQueryResult = mysqli_query($connection, $comment_count_query);
                echo '<div class="alert alert-success" role="alert">Comment Successfully Created</div>';
            }
            ?>
         <!-- Posted Comments -->
            <?php
                $post_id = $_GET['p_id'];
                $commentQuery="SELECT * FROM comments WHERE comment_post_id = '{$post_id}' AND comment_status = 'approved' ORDER BY comment_id DESC";
                $cQueryResult = mysqli_query($connection, $commentQuery);
                if (!$cQueryResult){
                    die("Query Failed: " . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_array($cQueryResult)){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
            ?>
               <!-- Comment -->
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div> 
            <?php } ?>
            <hr>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>
    </div>
    <div class="row">
        <div class="well">
            <!-- Comments Form -->
            <form action="" method="POST" role="form">
                <h4>Leave a Comment:</h4>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input class='form-control' type="text" name="comment_author" 
                    value="<?php
                    if(isset($_SESSION['username'])){
                        echo $_SESSION['username'];
                    } ?>
                    "
                    required/>
                </div>
                <div class="form-group">
                    <label for="comment_content">Comment</label>
                    <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                </div>
                <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<!-- /.row -->
<hr>
<?php include 'includes/footer.php' ?>