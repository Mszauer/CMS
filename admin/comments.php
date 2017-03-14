<?php include 'includes/header.php' ?>
    <div id="wrapper">
        <?php include 'includes/navbar.php' ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Viewing All Comments
                        </h1>
                        <?php
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            } else{
                                $source = '';
                            }
                            switch($source){
                                default:
                                    include "includes/view_all_comments.php";
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
