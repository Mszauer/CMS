<?php include 'includes/header.php' ?>
    <div id="wrapper">
        <?php include 'includes/navbar.php' ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the Admin section,
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                  <div class='huge'>
                                      <?php
                                        $post_query = "SELECT * FROM posts";
                                        $post_count = findCount($post_query);
                                        echo $post_count;
                                      ?>
                                  </div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- End widget -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <div class='huge'>
                                         <?php
                                         $comments_query = "SELECT * FROM comments";
                                         $comment_count = findCount($comments_query);
                                         echo $comment_count;
                                         ?>
                                     </div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- End widget -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'>
                                        <?php
                                        $user_query = "SELECT * FROM users";
                                        $user_count = findCount($user_query);
                                        echo $user_count;
                                        ?>
                                    </div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- End widget -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                            $category_query = "SELECT * FROM categories";
                                            $cat_count = findCount($category_query);
                                            echo $cat_count;
                                            ?>
                                        </div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- End widget -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php
                    $draft_query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $draft_count = findCount($draft_query);

                    $unapproved_query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    $unapproved_count = findCount($unapproved_query);

                    $normie_query = "SELECT * FROM users WHERE user_role = 'user'";
                    $normie_count = findCount($normie_query);
                    ?>
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);
                
                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Data', 'Count'],
                          <?php
                          $element_text = ['All Posts', 'Draft Posts', 'All Comments','Unapproved Comments', 'All Users', 'Users','Categories'];
                          $element_count = [$post_count, $draft_count, $comment_count, $unapproved_count, $user_count, $normie_count, $cat_count];
                          for($i = 0; $i < 7 ; $i++){
                              echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                          }
                          ?>
                        //   ['Posts', 1000]
                        ]);
                
                        var options = {
                          chart: {
                            title: '',
                            subtitle: '',
                          }
                        };
                
                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                
                        chart.draw(data, options);
                      }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php include 'includes/footer.php' ?>
