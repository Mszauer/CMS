<?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        echo $checkBoxValue;
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options){
            case 'delete':
                $delete_query = "DELETE FROM users WHERE user_id = {$checkBoxValue}";
                $delete_result = mysqli_query($connection,$delete_query);
                break;
        }
    }
}
?>
<form>
    <table class='table table-bordered table-hover'>
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class = "btn btn-success" value="Apply"/>
            <a href="./users.php?source=create" class="btn btn-primary">Add New</a>
        </div>
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAll" />
                </th>
                <th>User Id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
    
            <!-- Delete User -->
            <?php
            
            if(isset($_GET['delete'])){
                $u_id = $_GET['delete'];
                $query = "DELETE FROM users WHERE user_id = {$u_id}";
                $deleteQuery = mysqli_query($connection,$query);
            }
            
            ?>
            <!-- retrieve all posts-->
            <?php
            
                $query = "SELECT * FROM users";
                $queryResult = mysqli_query($connection,$query);
                if(!$queryResult){
                    die('Query Failed: ') . mysqli_error($connection);
                }
                while($row = mysqli_fetch_assoc($queryResult)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_image = $row['user_image'];
                    $user_role = $row['user_role'];
                    
                    echo "<tr>";
                    ?>
                    <td><input class = 'checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id ?>'></input></td>
                    <?php
                    echo "<td>{$user_id}</td>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$user_firstname}</td>";
                    echo "<td>{$user_lastname}</td>";
                    echo "<td>{$user_email}</td>";
                    echo "<td>{$user_role}</td>";
                    echo "<td><a href='users.php?source=update&u_id={$user_id}'>Update</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete {$username}?');\" href='users.php?delete={$user_id}'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>
            
        </tbody>
    </table>
</form>
