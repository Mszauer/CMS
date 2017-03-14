<?php include "db.php"; ?>
<?php ob_start() ?>
<?php session_start(); ?>

<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $queryResult = mysqli_query($connection,$query);
    if(!$queryResult){
        die("Query Failed: ") . mysqli_error($connection);
    }
    
    while($row = mysqli_fetch_array($queryResult)){
        $user_id = $row['user_id'];
        $user_name = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
    $password = crypt($password,$user_password);
    if($username === $user_name && $password === $user_password){
        $_SESSION['username'] = $user_name;
        echo '<div class="alert alert-success" role="alert">Login Successful</div>';
        header("Location: ../admin/index.php");
    } else {
        echo '<div class="alert alert-failure" role="alert">Login Failed</div>';
        header("Location: ../index.php");
    }
}
?>