<?php

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    
    $salt_query = "SELECT randSalt FROM users";
    $salt_result = mysqli_query($connection, $salt_query);
    if (!$salt_result){
        die("Salt Query Failed: " . mysqli_error($connection));
    }
    $row = mysqli_fetch_array($salt_result);
    $salt = $row['randSalt'];
    $password = crypt($password,$salt);
    
    $create_query = "INSERT INTO users (username, user_email, user_password, user_role) VALUES ('{$username}', '{$email}', '{$password}', 'user' ) ";
    $create_result = mysqli_query($connection, $create_query);
    if (!$create_result){
        die("Create Query Failed: " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
    }
    echo '<div class="alert alert-success" role="alert">User Successfully Created: <a href="users.php">View Users</a></div>';
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="author">First Name</label>
        <input type="text" name="user_firstname" class="form-control" />
    </div>
    <div class="form-group">
        <label for="status">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" />
    </div>
    <div class="form-group">
        <label for="tags">Password</label>
        <input type="password" class="form-control" name="user_password" />
    </div>
    <div class="form-group">
        <label for="status">Email</label>
        <input type="email" class="form-control" name="user_email" />
    </div>
    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="user_image"/>
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Create User" class="btn btn-primary">
    </div>
</form>