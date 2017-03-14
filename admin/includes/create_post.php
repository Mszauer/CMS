<?php

if(isset($_POST['submit'])){
    $post_title = mysqli_real_escape_string($connection, $_POST['title']);
    $post_author = mysqli_real_escape_string($connection, $_POST['author']);
    $post_category = mysqli_real_escape_string($connection, $_POST['category']);
    $post_status = mysqli_real_escape_string($connection, $_POST['status']);
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = mysqli_real_escape_string($connection, $_POST['tags']);
    $post_content = mysqli_real_escape_string($connection, $_POST['content']);
    $post_date = date('d-m-y');
    $post_comment_count = 0;
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ({$post_category}, '{$$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}') ";
    $postQuery = mysqli_query($connection, $query);
    if (!$postQuery){
        die("Post creation failed: " . mysqli_error($connection));
    }else{
        echo '<div class="alert alert-success" role="alert">Post Successfully Created: <a href="posts.php">View Posts</a></div>';
    }
    
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="category">Post Category</label>
        <select name="category" id="">
            <?php
                $catQuery = "SELECT * FROM categories";
                $catQueryResult = mysqli_query($connection,$catQuery);
                if(!$catQueryResult){
                    die('Query Failed: ') . mysqli_error($connection);
                }
                while($row = mysqli_fetch_assoc($catQueryResult)){
                    $catId = $row['cat_id'];
                    $catTitle=$row['cat_title'];
                    echo "<option value='$catId'>{$catTitle}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name="author" class="form-control" />
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" id="">
            <option value="draft">Draft</option>
            <option value="published">Publish</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image"/>
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" />
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Publish Post" class="btn btn-primary">
    </div>
</form>