<?php include "include/admin_header.php"; ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "include/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

        <?php
        static $msg="";
        

if (isset($_SESSION['id'])) {

    $user_toedit = $_SESSION['id'];

    $query_edit_user = " select * from users where user_id=$user_toedit; ";
    $result_ofedit = mysqli_query($connection, $query_edit_user);
    while ($res = mysqli_fetch_assoc($result_ofedit)) {
        $user_name = $res['user_name'];
        $user_password = $res['user_password'];
        $user_firstname = $res['user_firstname'];
        $user_lastname = $res['user_lastname'];
        $user_email = $res['user_email'];
        $user_image = $res['user_image'];
        $user_role = $res['user_role'];


?>


            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                    <?php if(empty($user_image))
                    {
                        echo "<img width=200 height=200 src='https://lh3.googleusercontent.com/proxy/fhkeEi1tGlV4aYY9S6LzSqRozVeLsrIVCBntxIwRY6YJSw3Amum9NdJ5kdV50Sah34wTrwiwuRGv3rp_eeJqSFUgwLz4zT0cz7e77oFJqgjkKBgOqZLXXqWhsI9R1D-xpCU'>"; 
                    }else{
                        echo" <img width=200 height=200 src='../image/$user_image'>";
                    }?>
                    
                         <?php if (isset($_SESSION['username'])) {
                                    echo $_SESSION['firstname'] . " " . $_SESSION['lastname']."'s Profile :)";
                                } else {
                                    echo "Guest admin";
                                } ?>
                        <!-- <small>Subheading</small> -->
                    </h1>

                </div>
            </div>
            <!-- /.row -->

            
<?php echo "<h4>$msg</h4>"; ?>

                    <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                    
                            
                      </div>
                        <div class="form-group">
                            <label for="title">Username:</label>
                            <input type="text" name="user_name" value="<?php echo $user_name; ?>" class="form-control">
                        </div>



                        <div class="form-group">
                            <label for="title">Password</label>
                            <input type="password" name="user_password" placeholder="Update password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="post_status">First Name:</label>
                            <input type="text" name="user_firstname" value="<?php echo $user_firstname; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="post_status">Last Name:</label>
                            <input type="text" name="user_lastname" value="<?php echo $user_lastname; ?>" class="form-control">
                        </div>

                        <div class="form-group">

                            <label for="user-role">User Role</label>
                            <select name="user_role" id="">
                                <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

                                <?php if ($user_role == 'ADMIN') {
                                    echo "<option value='SUBSCRIBER'>SUBSCRIBER</option>";
                                } else {
                                    echo "<option value='ADMIN'>ADMIN</option>";
                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="post_tag">E-Mail:</label>
                            <input type="text" name="user_email" value="<?php echo $user_email; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="post_image">Profile Picture</label>
                            <input type="file" name="user_image">
                        </div>
                        
                        

                        <div class="form-group">
                            <input type="submit" name="edit_user" class="btn btn-success" value="Update User">
                        </div>


                    </form>

            <?php }
            } ?>

            <?php
            if (isset($_POST['edit_user'])) {
                $user_name1 = $_POST['user_name'];
                $user_password1 = $_POST['user_password'];
                $user_firstname1 = $_POST['user_firstname'];
                $user_lastname1 = $_POST['user_lastname'];
                $user_email1 = $_POST['user_email'];
                $user_role1 = $_POST['user_role'];
                $user_image1 = $_FILES['user_image']['name'];


               

                if (empty($user_image1)) {
                    $user_image1 = $user_image;
                } else {
                    
                    $user_temp_image = $_FILES['user_image']['tmp_name'];
                    move_uploaded_file($user_temp_image, "../image/$user_image1");
                }





                if (empty($user_password1)) {
                    $user_password1 = $user_password;
                } else {


                    $query_for_salt = " select randSalt from users; ";
                    $salt_result = mysqli_query($connection, $query_for_salt);
                    $res_salt = mysqli_fetch_assoc($salt_result);
                    $hash_salt = $res_salt['randSalt'];
                    $user_password1 = crypt($user_password1, $hash_salt);
                }



                $query_edituser = "
    update users set
    
    user_name='$user_name1',
    user_password='$user_password1',
    user_firstname='$user_firstname1',
    user_lastname='$user_lastname1',
    user_email='$user_email1',
    user_image='$user_image1',
    user_role='$user_role1' 

    where user_id=$user_toedit
    ; ";


                $result_edituser = mysqli_query($connection, $query_edituser);

                $_SESSION['password'] = $user_password1;
                $_SESSION['username'] = $user_name1;
                $_SESSION['firstname'] = $user_firstname1;
                $_SESSION['lastname'] = $user_lastname1;
                $_SESSION['email'] = $user_email1;
                $_SESSION['role'] = $user_role1;

                $msg= "Awesome!! User Updated";

                header("Location: profile.php");
            }


            ?>





        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"; ?>