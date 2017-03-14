<?php include 'includes/header.php' ?>
<?php
if(!isAdmin($_SESSION['username'])){
    header("Location: index.php");
}
?>
    <div id="wrapper">
        <?php include 'includes/navbar.php' ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php
                            if(isset($_GET['source'])){
                                echo "Adding New User";
                            } else{
                                echo "Viewing All Users";
                            }
                            ?>
                        </h1>
                        <?php
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            } else{
                                $source = '';
                            }
                            switch($source){
                                case 'create':
                                    include "includes/create_user.php";
                                    break;
                                case 'update':
                                    include "includes/update_user.php";
                                    break;
                                default:
                                    include "includes/view_all_users.php";
                                    break;
                            }
                            
                        ?>
                    </div><!-- col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php include 'includes/footer.php' ?>
