<?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        echo $checkBoxValue;
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options){
            case 'approved':
                $publish_query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$checkBoxValue}";
                $publish_result = mysqli_query($connection,$publish_query);
                break;
            case 'unapproved':
                $update_query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$checkBoxValue}";
                $update_result = mysqli_query($connection,$update_query);
                break;
            case 'delete':
                $delete_query = "DELETE FROM comments WHERE comment_id = {$checkBoxValue}";
                $delete_result = mysqli_query($connection,$delete_query);
                break;
        }
    }
}
?>
<form action="" method="POST">
    <table class='table table-bordered table-hover'>
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="approved">Approve</option>
                <option value="unapproved">Unapprove</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class = "btn btn-success" value="Apply"/>
        </div>
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAll" />
                </th>
                <th>Comment Id</th>
                <th>Author</th>
                <th>Content</th>
                <th>Published</th>
                <th>Status</th>
                <th>Response to</th>
                <th>Approve</th>
                <th>Unpprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Approve Post -->
            <?php
            if(isset($_GET['unapprove'])){
                $comment_id = $_GET['unapprove'];
                $query="UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";
                $unapproveQuery = mysqli_query($connection,$query);
            }
            if(isset($_GET['approve'])){
                $comment_id = $_GET['approve'];
                $query="UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
                $unapproveQuery = mysqli_query($connection,$query);
            }
            ?>
            <!-- Delete Post -->
            <?php
            
            if(isset($_GET['delete'])){
                $c_id = $_GET['delete'];
                $query = "DELETE FROM comments WHERE comment_id = {$c_id}";
                $deleteQuery = mysqli_query($connection,$query);
            }
            
            ?>
            <!-- retrieve all posts-->
            <?php
            
                $query = "SELECT * FROM comments";
                $queryResult = mysqli_query($connection,$query);
                if(!$queryResult){
                    die('Query Failed: ') . mysqli_error($connection);
                }
                while($row = mysqli_fetch_assoc($queryResult)){
                    $comment_id = $row['comment_id'];
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_date = $row['comment_date'];
                    $comment_status = $row['comment_status'];
                    
                    echo "<tr>";
                    ?>
                    <td><input class = 'checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id ?>'></input></td>
                    <?php
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";
                    echo "<td>{$comment_date}</td>";
                    echo "<td>{$comment_status}</td>";
                    $authorQuery = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                    $aQueryResult = mysqli_query($connection,$authorQuery);
                    if(!$aQueryResult){
                        die('Query Failed: ') . mysqli_error($connection);
                    }
                    while ($row = mysqli_fetch_assoc($aQueryResult)){
                        $parentPost = $row['post_title'];
                        $parentId = $row['post_id'];
                        echo "<td><a href='../post.php?p_id=$parentId'>{$parentPost}</a></td>";
                    }
                    echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                    echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete the comment(s)?');\" href='comments.php?delete={$comment_id}'>Delete</a></td>";
                    echo "</tr>";
                }
            
            ?>
            
        </tbody>
    </table>
</form>
