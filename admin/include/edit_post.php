<?php date_default_timezone_set("Asia/Calcutta"); ?>
<?php

$post_id = $_GET['id'];
$temp_q = " select post_status from posts where post_id=$post_id; ";
$r = mysqli_query($connection, $temp_q);
while ($res = mysqli_fetch_assoc($r)) {
    $txt = $res['post_status'];
}




$query_disptext = " select * from posts where post_id=$post_id; ";
$result = mysqli_query($connection, $query_disptext);
while ($res = mysqli_fetch_assoc($result)) {

    $post_author = $res['post_aurthor'];
    $post_title = $res['post_title'];
    $post_catigory_id = $res['post_catigory_id'];
    if ($txt == 'DRAFT') {
        $post_status = 'PUBLISHED';
    } else {
        $post_status = $res['post_status'];
    }

    $post_image = $res['post_image'];
    $post_content = $res['post_content'];
    $post_tag = $res['post_tag'];
    $post_comment_count = $res['post_comment_count'];
}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post_title ?>">
    </div>

    <div class="form-group">

        <label for="Post_category">Post Category</label>
        <select name="post_category" id="">
            <?php

            $querry_cat = "select * from navigation;";

            $result_cat = mysqli_query($connection, $querry_cat);
            while ($res = mysqli_fetch_assoc($result_cat)) {
                $cat_id = $res['id'];
                $cat_name = $res['name'];
                if ($cat_id == $post_catigory_id) {
                    echo "<option value=" . "$cat_id" . " selected >" . "$cat_name" . "</option>";
                } else {
                    echo  "<option value=" . "$cat_id" . " >" . "$cat_name" . "</option>";
                }
            }

            ?>

        </select>

    </div>


    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" name="post_aurthor" class="form-control" value="<?php echo $post_author ?>">
    </div>



    <img src="../image/<?php echo $post_image ?>" width=200>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tag">Post Tag</label>
        <input type="text" name="post_tag" class="form-control" value="<?php echo $post_tag ?>">
    </div>

    <div class="form-group">
        <label for="">Post Content</label>
        <textarea type="text" name="post_content" class="form-control" id="" cols="30" rows="10"><?php echo $post_content ?></textarea>
    </div>



    <div class="form-group">
        <input type="submit" name="edit_post" class="btn btn-primary" value=<?php if ($txt == 'DRAFT') {
                                                                                echo " 'Publish Post' ";
                                                                            } else {
                                                                                echo "'Edit Post'";
                                                                            }
                                                                            ?>>
    </div>

</form>

<?php

if (isset($_POST['edit_post'])) {

    $post_aurthor1 = $_POST['post_aurthor'];
    $post_title1 = $_POST['post_title'];
    $post_catigory_id1 = $_POST['post_category'];
    $post_status1 = $post_status;

    $post_content1 = $_POST['post_content'];
    $post_tag1 = $_POST['post_tag'];

    $post_image = $_FILES['post_image']['name'];
    $post_temp_image = $_FILES['post_image']['tmp_name'];

    move_uploaded_file($post_temp_image, "../image/$post_image");

    if (empty($post_image)) {
        $q = " select post_image from posts where post_id=$post_id; ";
        $result_q = mysqli_query($connection, $q);
        while ($res_q = mysqli_fetch_assoc($result_q)) {
            $post_image = $res_q['post_image'];
        }
    }

    $post_date = date('d M Y');
    $post_time = date("h:i A");
    $post_time_stamp = mktime();



    $query_editpost = "update posts set
    post_catigory_id='$post_catigory_id1', post_title='$post_title1', post_aurthor='$post_aurthor1', post_date='$post_date',post_time='$post_time',time_stamp=$post_time_stamp,post_image='$post_image',post_content='$post_content1',post_tag='$post_tag1',post_status='$post_status1'
    where post_id=$post_id ;
    
    ";

    $result_editpost = mysqli_query($connection, $query_editpost);
    if (!$result_editpost) {
        echo "query error" . mysqli_error($connection);
    } else {
        header("Location: update_complete_page.php?id=$post_time_stamp");
    }
}
?>