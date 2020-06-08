<?php include "include/admin_header.php"; ?>



<?php
//code to get the number of posts in each catigory 

$sql = "select id from navigation;";
$result_sql = mysqli_query($connection, $sql);
while ($res_sql = mysqli_fetch_assoc($result_sql)) {
    $id = $res_sql['id'];
    $sql2 = " select count(*) as sum from posts where post_catigory_id=$id ; ";
    $result_sql2 = mysqli_query($connection, $sql2);
    $res_sql2 = mysqli_fetch_assoc($result_sql2);
    $count = $res_sql2['sum'];

    $sql3 = " update navigation set post_count=$count where id=$id ";
    mysqli_query($connection, $sql3);
}

?>



<?php
//deleting the category from table

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $querry_todelete = " delete from navigation where id=$delete_id; ";
    mysqli_query($connection, $querry_todelete);
    header("Location: category.php");
} else {
    echo "error";
}
?>

<?php
// inserting category into the table 

if (isset($_POST['submit_insert'])) {
    $add_cat = $_POST['add_cat'];
    if ($add_cat == '' || empty($add_cat)) {
        echo " Please enter a field";
    } else {
        $querry_toaddcat = " insert into navigation(name) values('$add_cat');";
        mysqli_query($connection, $querry_toaddcat);
    }
}
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "include/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Category control pannel
                        <!-- <small>arv24</small> -->
                    </h1>

                    <!-- input form -->
                    <div class="col-xs-6">

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="add-cat">Add New Category</label><br>

                                <input type="text" name="add_cat">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit_insert" value="Add Category">
                            </div>

                        </form>

                    </div>
                    <!-- input form -->

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th>Catrgory Title</th>
                                    <th>Posts in Category</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>




                                <?php

                                $querry_togetcat = " select * from navigation ";
                                $result1 = mysqli_query($connection, $querry_togetcat);

                                while ($res = mysqli_fetch_assoc($result1)) {

                                    $temp1 = $res['id'];
                                    $temp2 = $res['name'];
                                    $temp3 = $res['post_count'];

                                    echo "<tr><td>" .
                                        $temp2 .
                                        "</td><td>" .
                                        $temp3 .
                                        "</td><td>" .
                                        "<a onClick=\"javascript: return confirm('Are you sure you want to delete this category?'); \" href='category.php?delete_id=$temp1'>Delete</a>" .
                                        "               " .
                                        "<a href='category.php?edit_id=$temp1'>Edit</a>" .
                                        "</td></tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- code to edit the categories into the table -->
                    <?php
                    if (isset($_GET['edit_id'])) {
                        $edit_id = $_GET['edit_id'];
                        $temp_querry = "select name from navigation where id=$edit_id;";


                        $temp_result = mysqli_query($connection, $temp_querry);
                        while ($res_temp = mysqli_fetch_assoc($temp_result)) {
                    ?>
                            <div class="col-xs-6">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="add-cat">Edit Category</label><br>
                                        <input type="text" name="edit_cat" value=<?php echo $res_temp['name']; ?>>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="submit1" value="Edit Category">
                                    </div>

                                </form>
                            </div><?php }

                                if (isset($_POST['submit1'])) {
                                    $edit_cat = $_POST['edit_cat'];
                                    $querry_toeditcat = " update navigation set name='$edit_cat' where id=$edit_id ;";
                                    mysqli_query($connection, $querry_toeditcat);
                                    header("Location: category.php");
                                }
                            }
                                    ?>
                    <!-- editing form and required php -->

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "include/admin_footer.php"; ?>