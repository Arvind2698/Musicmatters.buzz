<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>

<!-- Navigation -->
<?php include "include/navi.php"; ?>
<?php date_default_timezone_set("Asia/Calcutta");  ?>




<!-- Page Content -->
<div class="container">

    <div class="row">


        <?php
        if (isset($_GET['id'])) {
            $post_id = $_GET['id'];


            $query_get_post = " select * from posts where post_id=$post_id; ";
            $result = mysqli_query($connection, $query_get_post);
            while ($res = mysqli_fetch_assoc($result)) {
                $post_title = $res['post_title'];
                $post_aurthor = $res['post_aurthor'];
                $post_date = $res['post_date'];
                $post_time = $res['post_time'];
                $post_image = $res['post_image'];
                $post_content = $res['post_content'];

        ?>


                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Blog Post -->

                    <!-- Title -->
                    <h1><?php echo $post_title ?></h1>

                    <!-- Author -->
                    <p class="lead">
                        by <a href='author_post.php?name=<?php echo $post_aurthor; ?>'><?php echo $post_aurthor ?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date . " " . $post_time; ?></p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-responsive" src="image/<?php echo $post_image ?>" alt="">

                    <hr>

                    <!-- Post Content -->
                    <p class="lead"><?php echo $post_content ?></p>

                    <hr>

            <?php
            }

            $view_count_query = " update posts set  post_view_count= post_view_count+1 where post_id=$post_id; ";
            mysqli_query($connection, $view_count_query);
        } ?>


            <?php
            // code for adding comments

            if (isset($_POST['submit_comment'])) {
                $author_name = $_POST['author_name'];
                $author_email = $_POST['author_email'];
                $author_content = $_POST['author_content'];
                $comment_date = date('d M Y');

                $query_addcomment = " insert into comments(comment_post_id,
                comment_author,
                comment_email,
                comment_content,
                comment_status,
                comment_date) 
                values($post_id, '$author_name' , '$author_email' , '$author_content' , 'APPROVED' , '$comment_date') ; ";

                $result_addcomment = mysqli_query($connection, $query_addcomment);
                if (!$result) {
                    echo mysqli_error($connection);
                }

                $q = " update posts set post_comment_count=post_comment_count+1 where post_id=$post_id; ";
                $resal = mysqli_query($connection, $q);
            } ?>




            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Enter your name:</label>
                        <input type="text" class="form-control" name="author_name">
                    </div>
                    <div class="form-group">
                        <label for="email">Enter your E-mail:</label>
                        <input type="email" class="form-control" name="author_email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" name="author_content" rows="3"></textarea>
                    </div>
                    <button type="submit" name="submit_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->




            <?php
            $query_disp = " select * from comments where comment_post_id=$post_id && comment_status='APPROVED';  ";
            $result_disp = mysqli_query($connection, $query_disp);
            while ($res_disp = mysqli_fetch_assoc($result_disp)) {
                $author_name = $res_disp['comment_author'];

                $author_content = $res_disp['comment_content'];
                $author_date = $res_disp['comment_date'];

            ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $author_name; ?>
                            <small><?php echo $author_date; ?></small>
                        </h4>
                        <?php echo $author_content; ?>
                    </div>

                </div>


            <?php } ?>
                </div>



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

                    <!-- user login page -->
                    <div class="well">
                        <h4>Login</h4>
                        <form action="include/login.php" method="post">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group"><input type="password" name="password" class="form-control" placeholder="Password">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                                </span>
                        </form>
                    </div>


                    <h5><a href="registration.php">New user? Register here </a></h5>
                </div>

                <!-- /.input-group -->
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
                                    echo " <li><a href='category.php?id=" . $temp1 . "'>$temp</a></li> ";
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

<hr>

<!-- Footer -->
<?php include "include/footer.php"; ?>