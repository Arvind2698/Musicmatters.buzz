<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>

<?php
$msg = "";
$count = "";



if (isset($_POST['submit'])) {
    $user_name = mysqli_real_escape_string($connection, $_POST['username']);
    $user_email = mysqli_real_escape_string($connection, $_POST['email']);
    $user_password = mysqli_real_escape_string($connection, $_POST['password']);

    $inoutdata_check = " select * from users; ";
    $check_result = mysqli_query($connection, $inoutdata_check);
    while ($res_result = mysqli_fetch_assoc($check_result)) {



        if (strcmp($user_name, $res_result['user_name']) == 0) {
            $count = 1;
        } else if (strcmp($user_name, $res_result['user_email']) == 0) {
            $count = 2;
        }
    }



    if (empty($user_name) || empty($user_email) || empty($user_password)) {
        echo "<script>alert('fields cannot be empty')</script>";
    } else {

        if ($count == 0) {
            $query_for_salt = " select randSalt from users; ";
            $salt_result = mysqli_query($connection, $query_for_salt);
            $res_salt = mysqli_fetch_assoc($salt_result);
            $hash_salt = $res_salt['randSalt'];
            $user_password = crypt($user_password, $hash_salt);
            $sql = " insert into users(user_name,user_password,user_email,user_role) values('$user_name','$user_password','$user_email','ADMIN');   ";
            $result_sql = mysqli_query($connection, $sql);
            $msg = "User Registered";
        } else if ($count = 1) {
            $msg = "Username already exists";
        } else if ($count = 2) {
            $msg = "Email already registered";
        }
    }
}
?>


<!-- Navigation -->

<?php include "include/navi.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <h4 class="text-center"><?php if ($count == 0) {
                                                            echo $msg;
                                                        } ?></h4>
                                <label for="username" class="sr-only">username</label>
                                <h5 class="text-center"><?php if ($count == 1) {
                                                            echo $msg;
                                                        } ?></h5>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <h5 class="text-center"><?php if ($count == 2) {
                                                            echo $msg;
                                                        } ?></h5>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "include/footer.php"; ?>