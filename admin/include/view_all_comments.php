<?php
if (isset($_GET['id'])) {
    $comment_id_del = $_GET['id'];
    $comment_post=$_GET['comment_post'];
    $query_del = " delete from comments where comment_id=$comment_id_del; ";
    $result_del = mysqli_query($connection, $query_del);
    $update_comments_post= " update posts set post_comment_count=post_comment_count-1 where post_id=$comment_post; ";
    mysqli_query($connection,$update_comments_post);

    header("Location: comments.php");
}
?>
<?php
if (isset($_GET['approve'])) {
    $comment_statuschange_id = $_GET['approve'];

    $querry_changestatus = " update comments set comment_status='APPROVED' where comment_id=$comment_statuschange_id;  ";
    mysqli_query($connection, $querry_changestatus);
    header("Location: comments.php");
}

?>
<?php
if (isset($_GET['decline'])) {
    $comment_statuschange_id = $_GET['decline'];

    $querry_changestatus = " update comments set comment_status='DECLINED' where comment_id=$comment_statuschange_id;  ";
    mysqli_query($connection, $querry_changestatus);
    header("Location: comments.php");
}

?>


<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <!-- <th>Id</th> -->
            <th>Commented Post</th>
            <th>Author</th>
            <th>Content</th>
            <th>E-mail</th>
            <th>Status</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Decline</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_allcomment = " select * from comments; ";
        $result_allcomment = mysqli_query($connection, $query_allcomment);
        while ($res = mysqli_fetch_assoc($result_allcomment)) {
            $comment_post_id = $res['comment_post_id'];
            $comment_id = $res['comment_id'];
            $comment_author = $res['comment_author'];
            $comment_content = $res['comment_content'];
            $comment_email = $res['comment_email'];
            $comment_status = $res['comment_status'];


            $temp_query = " select * from posts where post_id='$comment_post_id'; ";
            $result_temp = mysqli_query($connection, $temp_query);
            while ($res_temp = mysqli_fetch_assoc($result_temp)) {
                $post_location = $res_temp['post_id'];
                $comment_post = $res_temp['post_title'];


                $comment_date = $res['comment_date'];

                echo "<tr>";
               // echo " <td>$comment_id</td>";
               echo " <td><a href='../post.php?id=" . $post_location . "'>$comment_post</a></td>";
                echo " <td>$comment_author</td>";
                echo " <td>$comment_content</td>";
                echo " <td>$comment_email</td>";
                echo " <td>$comment_status</td>";
                
                echo " <td>$comment_date</td>";
                echo "  <td><a href='comments.php?approve=" . $comment_id . "'>Approve</a></td>";
                echo "  <td><a href='comments.php?decline=" . $comment_id . "'>Decline</a></td>";
                echo "  <td><a href='comments.php?id=" . $comment_id ."&comment_post=".$comment_post_id."'>Delete</a></td>";
                echo "</tr>";
            }
        }

        ?>

    </tbody>
</table>