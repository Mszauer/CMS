<!-- retrieve post-->
<?php
    // load specific post
    if(isset($_GET['p_id'])){
        $p_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = {$p_id}";
    $queryResult = mysqli_query($connection,$query);
    if(!$queryResult){
        die(' Find post query: Query Failed : ' . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($queryResult)){
        $postCatId = $row['category'];
        $postTitle = $row['post_title'];
        $postAuthor = $row['post_author'];
        $postDate = $row['post_date'];
        $postImage = $row['post_image'];
        $postContent = $row['post_content'];
        $postTags = $row['post_tags'];
        $postCommentCount = $row['post_comment_count'];
        $postStatus = $row['post_status'];
        $catQuery = "SELECT * FROM categories WHERE cat_id = '{$postCatId}'";
        $catQueryResult = mysqli_query($connection,$catQuery);
        if(!$catQueryResult){
            die('category find query: Query Failed: ' . mysqli_error($connection)) ;
        }
        while($row = mysqli_fetch_assoc($catQueryResult)){
            $category = $row['cat_title'];
        }
    }
    
    //update post upon submit
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
        $post_comment_count = 1;
            
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        if(empty($post_image)){
            $query="SELECT * FROM posts WHERE post_id='{$postCatId}'";
            $imageQuery=mysqli_query($connection,$query);
            while ($row = mysqli_fetch_array($imageQuery)){
                $post_image = $row['post_image'];
            }
        }
        
        $query= "UPDATE posts SET post_title='{$post_title}', post_category_id='{$post_category}', post_date = now(), post_author ='{$post_author}', post_status='{$post_status}', post_tags = '{$post_tags}', post_content='{$post_content}', post_image='{$post_image}' WHERE post_id={$p_id}";       
        $postQuery = mysqli_query($connection, $query);
        if(!$postQuery){
            echo "setting post failed: ";
            die('Query Failed: ' . mysqli_error($connection)) ;
        }
        echo '<div class="alert alert-success" role="alert">Post Successfully Updated: <a href="posts.php">View Posts</a></div>';

    }
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $postTitle; ?>" type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="category">Post Category</label>
        <select name="category" id="">
            <?php
                $catQuery = "SELECT * FROM categories";
                $catQueryResult = mysqli_query($connection,$catQuery);
                if(!$catQueryResult){
                    echo " Finding category failed: ";
                    die('Query Failed: '. mysqli_error($connection));
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
        <input value="<?php echo $postAuthor; ?>" type="text" name="author" class="form-control" />
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" id="">
            <option value="<?php echo $postStatus; ?>"><?php echo $postStatus; ?></option>
            <?php
            if($postStatus === 'published'){
                echo "<option value='draft'>Draft</option>";
            } else{
                echo "<option value='published'>Publish</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <img width=100; src='../images/<?php echo $post_image ?>' alt="Picture for post: <?php echo $post_image ?>">
        <input type="file" name="image"/>
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input value="<?php echo $postTags; ?>" type="text" class="form-control" name="tags" />
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?php echo $postContent; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Update Post" class="btn btn-primary">
    </div>
</form>