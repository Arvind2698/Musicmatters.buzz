<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <!-- <th>Id</th> -->
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Change roles</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_allusers = " select * from users; ";
        $result_allusers = mysqli_query($connection, $query_allusers);
        while ($res = mysqli_fetch_assoc($result_allusers)) {
            $user_id = $res['user_id'];
            $user_name = $res['user_name'];
            $user_firstname = $res['user_firstname'];
            $user_lastname = $res['user_lastname'];
            $user_email = $res['user_email'];
            $user_role = $res['user_role'];
            

            echo "<tr>";
            //echo " <td>$user_id</td>";
            echo " <td>$user_name</td>";
            echo " <td>$user_firstname</td>";    
            echo " <td>$user_lastname</td>";
            echo " <td>$user_email</td>";
            echo " <td>$user_role</td>";
            echo " <td><a href='users.php?admin=".$user_id."'>Admin</a>"."       "."<a href='users.php?sub=".$user_id."'>Subscriber</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete user?'); \" href='users.php?id=".$user_id."'>Delete</a>"."           " ."<a href='users_edit.php?id=".$user_id."'>Edit</a></td>";
           
            echo "</tr>";
        }

        ?>

    </tbody>
</table>

<?php 
//delete user
if(isset($_GET['id']))
{
    $user_del=$_GET['id'];
    $query_delete_user=" delete from users where user_id=$user_del; ";
    mysqli_query($connection,$query_delete_user);
    header("Location: users.php");
}

?>


<?php
//chage user to admin
if (isset($_GET['admin'])) {
    $role_admin_id = $_GET['admin'];

    $query_toadmin = " update users set user_role='ADMIN' where user_id=$role_admin_id;  ";
    mysqli_query($connection, $query_toadmin);
    header("Location: users.php");
}

?>


<?php
//change user to subscribere
if (isset($_GET['sub'])) {
    $role_sub_id = $_GET['sub'];

    $query_tosub = " update users set user_role='SUBSCRIBER' where user_id=$role_sub_id;  ";
    mysqli_query($connection, $query_tosub);
    header("Location: users.php");
}

?>