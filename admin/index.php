<?php include "include/admin_header.php"; ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "include/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">



            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome <?php if (isset($_SESSION['username'])) {
                                    echo " " . $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                                } else {
                                    echo "Guest admin";
                                } ?>
                        <!-- <small>Subheading</small> -->
                    </h1>

                </div>
            </div>
            <!-- /.row -->
            <?php

            $q1 = " select count(*) as sum from posts; ";
            $q2 = " select count(*) as sum from comments; ";
            $q3 = " select count(*) as sum from users; ";
            $q4 = " select count(*) as sum from navigation; ";

            $q5 = " select count(*) as sum from posts where post_status='DRAFT'; ";
            $q6 = " select count(*) as sum from posts where post_status='PUBLISHED'; ";
            $q7 = " select count(*) as sum from comments where comment_status='APPROVED'; ";
            $q8 = " select count(*) as sum from comments where comment_status='DECLINED'; ";

            $q9 = " select sum(post_view_count) as sum from posts;";

            $r1 = mysqli_query($connection, $q1);
            $r2 = mysqli_query($connection, $q2);
            $r3 = mysqli_query($connection, $q3);
            $r4 = mysqli_query($connection, $q4);


            $r5 = mysqli_query($connection, $q5);
            $r6 = mysqli_query($connection, $q6);
            $r7 = mysqli_query($connection, $q7);
            $r8 = mysqli_query($connection, $q8);

            $r9 = mysqli_query($connection, $q9);




            while ($res1 = mysqli_fetch_assoc($r1)) {
                $sum_posts = $res1['sum'];
            }
            while ($res2 = mysqli_fetch_assoc($r2)) {
                $sum_comments = $res2['sum'];
            }
            while ($res3 = mysqli_fetch_assoc($r3)) {
                $sum_users = $res3['sum'];
            }
            while ($res4 = mysqli_fetch_assoc($r4)) {
                $sum_navigation = $res4['sum'];
            }


            while ($res5 = mysqli_fetch_assoc($r5)) {
                $sum_draft = $res5['sum'];
            }
            while ($res6 = mysqli_fetch_assoc($r6)) {
                $sum_published = $res6['sum'];
            }
            while ($res7 = mysqli_fetch_assoc($r7)) {
                $sum_approved = $res7['sum'];
            }
            while ($res8 = mysqli_fetch_assoc($r8)) {
                $sum_declined = $res8['sum'];
            }
            while ($res9 = mysqli_fetch_assoc($r9)) {
                $sum_of_views = $res9['sum'];
            }



            ?>


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
                                    <div class='huge'><?php echo $sum_posts; ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="all_post.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $sum_comments; ?></div>
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
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $sum_users; ?></div>
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
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $sum_navigation; ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="category.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php
                        $arr_data = ['Published Posts', 'Draft Posts', 'Total views', 'Total comments', 'Approved Comments'];
                        $arr_val = [$sum_published, $sum_draft, $sum_of_views, $sum_comments, $sum_approved];
                        for ($i = 0; $i < 5; $i++) {
                            echo "['" . $arr_data[$i] . "', " . $arr_val[$i] . "],";
                        }
                        ?>






                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="columnchart_material" style="width: 'auto' ; height: 500px;"></div>








        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"; ?>