<?php
function queryCheck($resultQuery){
    global $connection;
    if(!$resultQuery){
        die('Query Failed'.mysqli_error($connection));
    }
}

function createCategory(){
    global $connection;
    if(isset($_POST['submit'])){
        $title = $_POST['cat_title'];
        if($title == "" || empty($title)){
            echo "Category can not be empty";
        } else{
            $query = "INSERT INTO categories(cat_title) VALUE ('{$title}') ";
            $createQuery = mysqli_query($connection,$query);
            if(!$createQuery){
                die('Query Failed: ') . mysqli_error($connection);
            }
        }
    }
}

function readCategories(){
    global $connection;
    $query = "SELECT * FROM categories LIMIT 5";
    $queryResult = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($queryResult)){
        echo "<tr>";
        $catTitle = $row['cat_title'];
        $catId = $row['cat_id'];
        echo "<td>{$catId}</td>";
        echo "<td>{$catTitle}</td>";
        echo "<td><a href='categories.php?delete={$catId}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$catId}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategory(){
    global $connection;
    if(isset($_GET['delete'])){
        $deleteId = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$deleteId} ";
        $deleteQuery = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}

function isAdmin($username){
    global $connection;
    $admin_query = "SELECT user_role FROM users WHERE username = '$username'";
    $admin_result = mysqli_query($connection, $admin_query);
    $row = mysqli_fetch_array($admin_result);
    if($row['user_role'] == 'admin'){
        return true;
    } else{
        return false;
    }
}

function findCount($query = ''){
    global $connection;
    $query_result = mysqli_query($connection,$query);
    $query_count = mysqli_num_rows($query_result);
    return $query_count;
}
?>