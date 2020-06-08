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

            $count_post_query = " select count(*) as sum from posts; ";
            $result = mysqli_query($connection, $count_post_query);
            $res = mysqli_fetch_assoc($result);
            $sum_post = $res['sum'];

            $number_of_page = ceil($sum_post / 3); //number of page

            

            if(isset($_GET['page']))
            {
                $current_page=$_GET['page'];
                $page_start=$current_page*3-3;               
            }
            else{
                $current_page=1;
                $page_start=0;                
            }           

            
            $querry = " select * from posts where post_status='PUBLISHED'  limit $page_start,3  ; ";
            $result = mysqli_query($connection, $querry);
            while ($res = mysqli_fetch_assoc($result)) {
                $post_id = $res['post_id'];
                $post_title = $res['post_title'];
                $post_aurthor = $res['post_aurthor'];
                $post_date = $res['post_date'];
                $post_time=$res['post_time'];
                $post_image = $res['post_image'];
                $post_content = $res['post_content'];
            ?>

                <h2>
                    <a href="post.php?id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href='author_post.php?name=<?php echo $post_aurthor; ?> '><?php echo $post_aurthor; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo "  Posted on" ."  ". $post_date . "   ".$post_time; ?> </p>
                <hr>
                <a href="post.php?id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src=<?php echo 'image/' . $post_image; ?> alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } ?>

            <!-- First Blog Post -->









            <!-- Pager -->
            <ul class="pager">
                
                <?php 
                for($i=1;$i<=$number_of_page;$i++)
                {
                    if($i==$current_page)
                    {
                        echo "<li  ><a class='active_link' href='index.php?page=$i'>$i</a></li>";        
                    }else{
                echo "<li><a href='index.php?page=$i'>$i</a></li>";}
                }
               
                ?>
            </ul>

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
            <?php 
            if(isset($_GET['id']))
            {
                $status_id=$_GET['id'];
                switch($status_id)
                {
                    case 1: $status=" Password incorrect ";

                    break;
                    case 2: $status=" Invalid username ";

                    break;
                    case 3: $status=" Username or Password can not be empty";

                    break;

                    default: 
                }

            }else{$status="";}
            ?>

            <!-- user login page -->
            <div class="well">
                <h4>Login</h4>
                <form action="include/login.php" method="post">
                <?php echo $status; ?>
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
<!-- /.row -->

<hr>

<!-- Footer -->
<?php include "include/footer.php"; ?>