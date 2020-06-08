<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>
<!-- Navigation -->
<?php include "include/navi.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>






<?php  
if(isset($_GET['id']))
{
    $post_cat_id=$_GET['id'];
}
?>




            <!-- First Blog Post -->

            <?php
            $querry = " select * from posts where post_catigory_id=$post_cat_id; ";
            $result = mysqli_query($connection, $querry);
            while ($res = mysqli_fetch_assoc($result)) {
                $post_id=$res['post_id'];
                $post_title = $res['post_title'];
                $post_aurthor = $res['post_aurthor'];
                $post_date = $res['post_date'];
                $post_image = $res['post_image'];
                $post_content = $res['post_content'];
            ?>

                <h2>
                    <a href="post.php?id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_aurthor; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo "Posted on" . $post_date . " at 10:00 PM"; ?> </p>
                <hr>
                <img class="img-responsive" src=<?php echo 'image/'.$post_image; ?> alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } ?>

            <!-- First Blog Post -->









            <!-- Pager -->
            <?php include "include/pager.php"; ?>

        </div>



        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">



            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <div class="input-group">
                    <form action="searchengine.php" method="post">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="submit" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </form>
                </div>
                <!-- /.input-group -->
            </div>



            <!-- Blog Categories Well -->
            <?php
            $querry = " select * from navigation; ";
            $result = mysqli_query($connection, $querry);

            ?>

            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">

                            <?php
                            while ($res = mysqli_fetch_assoc($result)) {
                                $temp = $res['name'];
                                $temp1 = $res['id'];
                                echo " <li><a href='category.php?id=".$temp1."'>$temp</a></li> ";
                            } ?>

                        </ul>
                    </div>

            <!-- Blog Categories Well -->
            
            
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                            <li><a href="#">Category Name</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
            </div>



            
            <!-- Side Widget Well -->
            <?php include "include/sidewidget.php"; ?>

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "include/footer.php"; ?>