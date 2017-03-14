<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">CMS Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                    <?php
                    if (isset($_SESSION['username'])){
                        if(isAdmin(($_SESSION['username']))){
                            echo "<li><a href='admin'>Admin</a></li>";
                        }
                        echo "<li><a href=''>Logout</a></li>";
                        if(isset($_GET['p_id'])){
                            $p_id = $_GET['p_id'];
                            $creater_query = "SELECT username FROM users WHERE username = '{$_SESSION['username']}' ";
                            $creater_result = mysqli_query($connection,$creater_query);
                            $row = mysqli_fetch_array($creater_result);
                            $user = $row['username'];
                            if (isAdmin(($_SESSION['username'])) || $user == $_SESSION['username']){
                                echo "<li> <a href='./admin/posts.php?source=update&p_id={$p_id}'>Edit Post</a></li>";
                            }
                        }
                    } else{
                        echo "<li><a href='../registration.php'>Register</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>