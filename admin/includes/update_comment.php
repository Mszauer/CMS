<!-- retrieve post-->
<?php
    // load specific post
    if(isset($_GET['c_id'])){
        $c_id = $_GET['c_id'];
    }

    $query = "SELECT * FROM comments WHERE comment_id={$c_id}";
    $queryResult = mysqli_query($connection,$query);
    if(!$queryResult){
        die('Query Failed: ') . mysqli_error($connection);
    }
    while($row = mysqli_fetch_assoc($queryResult)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $authorQuery = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $aQueryResult = mysqli_query($connection,$authorQuery);
        if(!$aQueryResult){
            die('Query Failed: ') . mysqli_error($connection);
        }
        while ($row = mysqli_fetch_assoc($aQueryResult)){
            $parentPost = $row['post_title'];
        }
    }
    
    //update post upon submit
    if(isset($_POST['submit'])){
        $post_author = $_POST['author'];
        $post_status = $_POST['status'];
        $post_content = $_POST['content'];
        $comment_date = date('d-m-y');
        
        $query= "UPDATE comments SET comment_post_id = $comment_post_id, comment_date = now(), comment_author = '$post_author', comment_content = '$post_content', comment_status ='$post_status' WHERE comment_id = $c_id";       
        $postQuery = mysqli_query($connection, $query);
        if(!$postQuery){
            die('Query Failed: ') . mysqli_error($connection);
        }
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
    <!--<div class="form-group">-->
    <!--    <label for="category">Post Category</label>-->
    <!--    <select name="category" id="">-->
    <!--        <?php
    // <!--            $catQuery = "SELECT * FROM categories";-->
    // <!--            $catQueryResult = mysqli_query($connection,$catQuery);-->
    // <!--            if(!$catQueryResult){-->
    // <!--                die('Query Failed: ') . mysqli_error($connection);-->
    // <!--            }-->
    // <!--            while($row = mysqli_fetch_assoc($catQueryResult)){-->
    // <!--                $catId = $row['cat_id'];-->
    // <!--                $catTitle=$row['cat_title'];-->
    // <!--                echo "<option value='$catId'>{$catTitle}</option>";-->
    // <!--            }-->
            ?>-->
    <!--    </select>-->
    <!--</div>-->
    <div class="form-group">
        <label for="content">Comment Content</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?php echo $comment_content; ?></textarea>
    </div>
    <div class="form-group">
        <label for="author">Comment Author</label>
        <input value="<?php echo $comment_author; ?>" type="text" name="author" class="form-control" />
    </div>
    <div class="form-group">
        <label for="status">Comment Status</label>
        <input value="<?php echo $comment_status; ?>" type="text" class="form-control" name="status" />
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Update Comment" class="btn btn-primary">
    </div>
</form>