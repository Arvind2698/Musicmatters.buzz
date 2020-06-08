<?php session_start()  ?>
<?php include "db.php"; ?>
<?php

if (isset($_POST['login'])) {


    $username = $_POST['username'];
    $password = $_POST['password'];
$username=mysqli_real_escape_string($connection,$username);
$password=mysqli_real_escape_string($connection,$password);

    if (empty($username) || empty($password)) {
        $status= "user name or password can not be empty";
        header("Location: ../index.php?id=3");
    } else {

        $check_query = " select * from users where user_name='$username' ;";
        $result = mysqli_query($connection, $check_query);

        if (mysqli_num_rows($result) > 0) {
            while ($res = mysqli_fetch_assoc($result)) {
                $db_id=$res['user_id'];
                $db_password = $res['user_password'];
                $db_firstname = $res['user_firstname'];
                $db_lastname = $res['user_lastname'];
                $db_email = $res['user_email'];
                $db_role = $res['user_role'];
                $password=crypt($password,$db_password);
            }
            if ($password === $db_password) {

                if ($db_role == 'ADMIN') {

                    $_SESSION['id']=$db_id;
                    $_SESSION['password']=$db_password;
                    $_SESSION['username'] = $username;
                    $_SESSION['firstname'] = $db_firstname;
                    $_SESSION['lastname'] = $db_lastname;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['role']=$db_role;
                    
                    header("Location: ../admin/index.php");
                } else {
                    header("Location: ../index.php");
                }
            } else {
                $status="wrong password";
                header("Location: ../index.php?id=1");

            }
        } else {
            $status="wrong user name";
            header("Location: ../index.php?id=2");
        }
    }
}
