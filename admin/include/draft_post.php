<?php
        $query_allpost = " select * from posts where post_status='DRAFT'; ";
        $result_allpost = mysqli_query($connection, $query_allpost); 
        $res1 = mysqli_fetch_assoc($result_allpost);
        if(empty($res1))
        {
            echo "<h1 class='page-header'>No pending draft posts</h1>";
        }
        else{
            

?>

<h1 class='page-header'>Posts yet to be published!!</h1>

<table class="table table-bordered table-hover">
    <thead>
        <tr>

            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Image</th>
            <th>Content</th>
            <th>Options</th>

        </tr>
    </thead>
    <tbody>

        <?php
        $query_allpost = " select * from posts where post_status='DRAFT'; ";
        $result_allpost = mysqli_query($connection, $query_allpost);
        while ($res = mysqli_fetch_assoc($result_allpost)) {
            $post_id = $res['post_id'];
            $post_author = $res['post_aurthor'];
            $post_title = $res['post_title'];
            $post_catigory_id = $res['post_catigory_id'];
            $post_image = $res['post_image'];
            $post_content = $res['post_content'];

            //$post_status = $res['post_status'];
            //$post_tag = $res['post_tag'];
            //$post_comment_count = $res['post_comment_count'];
            //$post_date = $res['post_date'];
            //$post_view_count=$res['post_view_count'];

            echo "<tr>";
            echo " <td>$post_author</td>";
            echo " <td>$post_title</td>";

            $query_catid = " select name from navigation where id=$post_catigory_id; ";
            $result_catid = mysqli_query($connection, $query_catid);
            while ($res_catid = mysqli_fetch_assoc($result_catid)) {
                $temp = $res_catid['name'];
                echo "<td>$temp</td>";
            }

            echo " <td ><img width=100  src=" . "'../image/" . "$post_image'></td>";
            echo " <td>$post_content</td>";
            echo " <td><a href='all_post_edit.php?id=" . $post_id . "'>Edit</a></td> ";
            echo "</tr>";
        }
    }

?>   
    </tbody>
</table>