<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">
    <?php
        if(isset($_POST['submit'])){
            $search = $_POST['search'];
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            $queryResult = mysqli_query($connection,$query);
            if(!$queryResult){
                die("Query Failed: " . mysqli_error($connection));
            }
            $count = mysqli_num_rows($queryResult);
            if ($count == 0){

            }
        }
    ?>
    <!-- Login -->
    <div class="well">
        <?php
        if(isset($_SESSION['username'])){
            echo "<h4> Logged in as {$_SESSION['username']}</h4>";
            echo "<a href='./includes/logout.php' class='btn btn-danger'>Logout</a>";
        }
        else{ ?>
            <h4>Login</h4>
            <form action="./includes/login.php" method="post">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Username">
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">
                            Login
                        </button>
                    </span>
                </div>
            </form>
            <!-- End form -->
        <?php } ?>
        
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                     <?php 
                        $query = "SELECT * FROM categories LIMIT 5";
                        $queryResult = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($queryResult)){
                            $catTitle = $row['cat_title'];
                            $catId = $row['cat_id'];
                            echo "<li><a href='category.php?category=$catId'> {$catTitle} </a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>
</div>