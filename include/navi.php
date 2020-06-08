<?php include "db.php"; ?>
<?php session_start() ?>
<?php

?>
<?php
$querry = " select * from navigation; ";
$result = mysqli_query($connection, $querry); ?>
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
            <a class="navbar-brand" href="index.php">Start Bootstrap</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                while ($res = mysqli_fetch_assoc($result)) {
                    $temp = $res['name'];
                    echo " <li><a href='#'>$temp</a></li> ";
                }
                if (isset($_SESSION['id'])) {
                    if ($_SESSION['role'] === "ADMIN") {
                        echo " <li><a href='admin/index.php'>Admin</a></li> ";
                    }

                }
                
                
                ?>

            </ul>
            <ul class="nav navbar-right top-nav">



            </ul>

        </div>












        </li>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>