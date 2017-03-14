<?php include 'includes/header.php' ?>
    <div id="wrapper">
        <?php include 'includes/navbar.php' ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Viewing All Categories
                        </h1>
                        <div class="col-xs-6">
                            <?php
                                createCategory();
                            ?>
                            <form action="" method="POST">
                                <label for="cat_title">Add a Category</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="cat_title" required/>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category" />
                                </div>
                            </form>
                            <?php
                            if(isset($_GET['edit'])){
                                $editId = $_GET['edit'];
                                include 'includes/update_categories.php';
                            }
                            ?>
                        </div>
                        <div class="col-xs-6">
                            
                            
                            <table class='table table-bordered table-hover'>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th>Delete</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            readCategories();
                                        ?>
                                        <?php
                                            deleteCategory();
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php include 'includes/footer.php' ?>
