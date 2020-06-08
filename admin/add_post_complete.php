<?php include "include/admin_header.php"; ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "include/admin_navigation.php" ?>


        <div id="page-wrapper">

            <div class="container-fluid">

            <?php
            if(isset($_GET['id']))
            {
                $post_time_stamp=$_GET['id'];
                $get_id=" select post_id from posts where time_stamp=$post_time_stamp; ";
                $result=mysqli_query($connection,$get_id);
                $res=mysqli_fetch_assoc($result);
                $post_id=$res['post_id'];
            }
            
            ?>


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Post Published
                            <small><a href='../post.php?id=<?php echo $post_id; ?>'> Go to your post</a></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->





            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"; ?>
