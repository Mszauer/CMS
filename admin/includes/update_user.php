<!-- retrieve post-->
<?php
    // load specific user
    if(isset($_GET['u_id'])){
        $u_id = $_GET['u_id'];
    }

    $query = "SELECT * FROM users WHERE user_id={$u_id}";
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
        $user_salthash = $row['randSalt'];
    }
    
    //update user upon submit
    if(isset($_POST['submit'])){
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_role = $_POST['user_role'];
        
        //move_uploaded_file($post_image_temp, "../images/$post_image");
        
        if(empty($post_image)){
            $query="SELECT * FROM users WHERE user_id='{$user_id}'";
            $imageQuery=mysqli_query($connection,$query);
            while ($row = mysqli_fetch_array($imageQuery)){
                $user_new_image = $row['user_image'];
            }
        }
        $user_password = crypt($user_password,$user_salthash);
        $query= "UPDATE users SET username='{$username}', user_password='{$user_password}', user_firstname ='{$user_firstname}', user_lastname='{$user_lastname}', user_email = '{$user_email}', user_image='{$user_image}', user_role='{$user_role}' WHERE user_id={$u_id}";       
        $postQuery = mysqli_query($connection, $query);
        if(!$postQuery){
            die('Query Failed: ') . mysqli_error($connection);
        }
        echo '<div class="alert alert-success" role="alert">User Successfully Updated: <a href="users.php">View Users</a></div>';
    }
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input value="" type="password" class="form-control" name="user_password" placeholder="Insert current or your new password" required/>
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input value="<?php echo $user_firstname; ?>" type="text" name="user_firstname" class="form-control" />
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname" />
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email" />
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label>
        <img width=100; src='../images/<?php echo $user_image ?>' alt="Picture for post: <?php echo $user_image ?>">
        <input type="file" name="user_image"/>
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" id="">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
            <?php
            if ($user_role == 'admin'){
                echo "<option value='user'>User</option>";
            }
            else{
                echo "<option value='admin'>Admin</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Update User" class="btn btn-primary">
    </div>
</form>