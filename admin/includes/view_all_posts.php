<?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options){
            case 'published':
                $publish_query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
                $publish_result = mysqli_query($connection,$publish_query);
                break;
            case 'draft':
                $update_query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
                $update_result = mysqli_query($connection,$update_query);
                break;
            case 'duplicate':
                $clone_query = "SELECT * FROM posts WHERE post_id = '{$checkBoxValue}' ";
                $clone_result = mysqli_query($connection, $clone_query);
                while ($row = mysqli_fetch_array($clone_result)){
                    $post_id = $row['post_id'];
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = $row['post_status'];
                }
                $insert_query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', '{$$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}') ";
                $post_result = mysqli_query($connection, $insert_query);
                if (!$post_result){
                    die("Clone insert query failed: " . mysqli_error($connection));
                }
                break;
            case 'delete':
                $delete_query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
                $delete_result = mysqli_query($connection,$delete_query);
                break;
        }
    }
}
?>
<form action="" method='POST'>
    <table class='table table-bordered table-hover'>
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="duplicate">Duplicate</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class = "btn btn-success" value="Apply"/>
            <a href="./posts.php?source=create" class="btn btn-primary">Add New</a>
        </div>
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAll" />
                </th>
                <th>Post Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Published</th>
                <th>Image</th>
                <td>Content</td>
                <th>Tags</th>
                <th>Comment Count</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Delete Post -->
            <?php
            
            if(isset($_GET['delete'])){
                $post_id = $_GET['delete'];
                $query = "DELETE FROM posts WHERE post_id = {$post_id}";
                $deleteQuery = mysqli_query($connection,$query);
            }
            
            ?>
            <!-- retrieve all posts-->
            <?php
            
                $query = "SELECT * FROM posts ORDER BY post_id DESC ";
                $queryResult = mysqli_query($connection,$query);
                if(!$queryResult){
                    die('Query Failed: ') . mysqli_error($connection);
                }
                while($row = mysqli_fetch_assoc($queryResult)){
                    $postId = $row['post_id'];
                    $postCatId = $row['post_category_id'];
                    $postTitle = $row['post_title'];
                    $postAuthor = $row['post_author'];
                    $postDate = $row['post_date'];
                    $postImage = $row['post_image'];
                    $postContent = substr($row['post_content'],0,100) . "...";
                    $postTags = $row['post_tags'];
                    $postCommentCount = $row['post_comment_count'];
                    $postStatus = $row['post_status'];
                    
                    echo "<tr>";
                    ?>
                    <td><input class = 'checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $postId ?>'></input></td>
                    <?php
                    echo "<td>{$postId}</td>";
                    echo "<td>{$postAuthor}</td>";
                    echo "<td><a href='../post.php?p_id={$postId}'>{$postTitle}</a></td>";
                    
                    $catQuery = "SELECT * FROM categories WHERE cat_id = '{$postCatId}'";
                    $catQueryResult = mysqli_query($connection,$catQuery);
                    if(!$catQueryResult){
                        die('Query Failed: ') . mysqli_error($connection);
                    }
                    while($row = mysqli_fetch_assoc($catQueryResult)){
                        $category = $row['cat_title'];
                        echo "<td>{$category}</td>";
                    }
                    
                    echo "<td>{$postDate}</td>";
                    echo "<td><img width='100' src='../images/{$postImage}'></td>";
                    echo "<td>{$postContent}</td>";
                    echo "<td>{$postTags}</td>";
                    echo "<td>{$postCommentCount}</td>";
                    echo "<td>{$postStatus}</td>";
                    echo "<td><a href='posts.php?source=update&p_id={$postId}'>Update</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete the post(s)?');\" href='posts.php?delete={$postId}'>Delete</a></td>";
                    echo "</tr>";
                }
            
            ?>
            
        </tbody>
    </table>
</form>