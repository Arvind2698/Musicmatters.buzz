<?php

if (isset($_POST['add_user'])) {



    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    $query_for_salt = " select randSalt from users; ";
    $salt_result = mysqli_query($connection, $query_for_salt);
    $res_salt = mysqli_fetch_assoc($salt_result);
    $hash_salt = $res_salt['randSalt'];
    $user_password = crypt($user_password, $hash_salt);

    // $user_image = $_FILES['user_image']['name'];
    // $user_temp_image = $_FILES['user_image']['tmp_name'];
    // move_uploaded_file($user_temp_image, "../image/$user_image");

    $query_adduser = "
    INSERT INTO users
    (
    user_name,
    user_password,
    user_firstname,
    user_lastname,
    user_email,
    
    user_role
    )  

    VALUES (
    '$user_name',
    '$user_password',
    '$user_firstname',
    '$user_lastname',
    '$user_email',
    
    '$user_role'
    ); ";


    $result_adduser = mysqli_query($connection, $query_adduser);
    if (!$result_adduser) {
        echo "query error" . mysqli_error($connection);
    } else {
        header("Location: add_user_complete.php");
    }
}


?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Username:</label>
        <input type="text" name="user_name" class="form-control">
    </div>



    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status">First Name:</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status">Last Name:</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">

        <label for="user-role">User Role</label>
        <select name="user_role" id="">
            <option value="SUBSCRIBER">Select an option</option>
            <option value="ADMIN">ADMIN</option>
            <option value="SUBSCRIBER">SUBSCRIBER</option>
        </select>

    </div>

    <div class="form-group">
        <label for="post_tag">E-Mail:</label>
        <input type="text" name="user_email" class="form-control">
    </div>

    <!-- <div class="form-group">
        <label for="userimage">User Image</label>
        <input type="file" name="user_image">
    </div> -->

    <div class="form-group">
        <input type="submit" name="add_user" class="btn btn-primary" value="Add User">
    </div>


</form>