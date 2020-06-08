<?php

if (isset($_GET['id'])) {

       

    $user_toedit = $_GET['id'];

    $query_edit_user = " select * from users where user_id=$user_toedit; ";
    $result_ofedit = mysqli_query($connection, $query_edit_user);
    while ($res = mysqli_fetch_assoc($result_ofedit)) {
        $user_name = $res['user_name'];
        $user_password = $res['user_password'];
        $user_firstname = $res['user_firstname'];
        $user_lastname = $res['user_lastname'];
        $user_email = $res['user_email'];
        $user_role = $res['user_role'];
        
?>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Username:</label>
                <input type="text" name="user_name" value="<?php echo $user_name; ?>" class="form-control">
            </div>



            <div class="form-group">
                <label for="title">Password</label>
                <input type="password" placeholder="Change password" name="user_password" value="" class="form-control">
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

            <!-- <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="post_image">
    </div> -->


            <div class="form-group">
                <input type="submit" name="edit_user" class="btn btn-primary" value="Edit User">
            </div>


        </form>

<?php
    }
} ?>

<?php
if (isset($_POST['edit_user'])) {
    $user_name1 = $_POST['user_name'];
    $user_password1 = $_POST['user_password'];
    $user_firstname1 = $_POST['user_firstname'];
    $user_lastname1 = $_POST['user_lastname'];
    $user_email1 = $_POST['user_email'];
    $user_role1 = $_POST['user_role'];

    // $user_image = $_FILES['user_image']['name'];
    // $user_temp_image = $_FILES['user_image']['tmp_name'];
    // move_uploaded_file($post_temp_image, "../image/$post_image");


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
    user_role='$user_role1' 

    where user_id=$user_toedit
    ; ";


    $result_edituser = mysqli_query($connection, $query_edituser);
    header("Location: edit_user_complete.php");
}


?>