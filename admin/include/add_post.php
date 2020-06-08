<?php date_default_timezone_set("Asia/Calcutta"); ?>
<?php

if (isset($_POST['publish_post'])) {


    $post_catigory_id = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_aurthor = $_POST['post_aurthor'];
    $post_date = date('d M Y');
    $post_time=date('h:i A');
    $post_image = $_FILES['post_image']['name'];
    $post_temp_image = $_FILES['post_image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tag = $_POST['post_tag'];
    $post_comment_count = 0 ;
    $post_status = 'PUBLISHED';
    $post_time_stamp=mktime();

    move_uploaded_file($post_temp_image, "../image/$post_image");

    $query_addpost =

        " insert into posts(post_catigory_id,
    post_title,
    post_aurthor,
    post_date,
    post_time,
    time_stamp,
    post_image,
    post_content,
    post_tag,
    post_comment_count,
    post_status)

    values
    ($post_catigory_id,
    '$post_title',
    '$post_aurthor', 
    '$post_date' ,
    '$post_time',
    '$post_time_stamp',
    '$post_image',
    '$post_content',
    '$post_tag',
    '$post_comment_count',
    '$post_status' 
    );

    ";
    $result_addpost = mysqli_query($connection, $query_addpost);
    if (!$result_addpost) {
        echo "query error" . mysqli_error($connection);
    }else{

        header("Location: add_post_complete.php?id=$post_time_stamp");
    }
}
?>
<?php

if (isset($_POST['draft_post'])) {


    $post_catigory_id = $_POST['post_category'];
    $post_title = $_POST['post_title'];
    $post_aurthor = $_POST['post_aurthor'];
    $post_date = date('d M Y');
    $post_time=date("h:i A");
    $post_image = $_FILES['post_image']['name'];
    $post_temp_image = $_FILES['post_image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tag = $_POST['post_tag'];
    $post_comment_count = 0 ;
    $post_status = 'DRAFT';
    $post_time_stamp=mktime();

    move_uploaded_file($post_temp_image, "../image/$post_image");

    $query_addpost =

        " insert into posts(post_catigory_id,
    post_title,
    post_aurthor,
    post_date,
    post_time,
    time_stamp,
    post_image,
    post_content,
    post_tag,
    post_comment_count,
    post_status)

    values
    ($post_catigory_id,
    '$post_title',
    '$post_aurthor', 
    '$post_date',
    '$post_time',
    '$post_time_stamp',
    '$post_image',
    '$post_content',
    '$post_tag',
    '$post_comment_count',
    '$post_status'
     
    );

    ";
    $result_addpost = mysqli_query($connection, $query_addpost);
    if (!$result_addpost) {
        echo "query error" . mysqli_error($connection);
    }else{

        header("Location: add_draft_complete.php");
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
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
                echo "<option value=" . $cat_id . ">" .$cat_name. "</option>";
            }

            ?>

        </select>

    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" name="post_aurthor" class="form-control">
    </div>

    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tag">Post Tag</label>
        <input type="text" name="post_tag" class="form-control">
    </div>

    <div class="form-group">
        <label for="">Post Content</label>
        <textarea type="text" id="body" name="post_content" class="form-control"  cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="publish_post" class="btn btn-success" value="Publish Post">
        <input type="submit" name="draft_post" class="btn btn-primary" value="Save Draft">
    </div>
    


</form>