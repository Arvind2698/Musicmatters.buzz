<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <!-- <th>Id</th> -->
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <!-- <th>Content</th> -->
            <th>Tags</th>
            <th>Comments</th>
            <th>Views</th>
            <!-- <th>Date</th> -->
            <th>Options</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        $query_allpost = " select * from posts; ";
        $result_allpost = mysqli_query($connection, $query_allpost);
        while ($res = mysqli_fetch_assoc($result_allpost)) {
            $post_id = $res['post_id'];
            $post_author = $res['post_aurthor'];
            $post_title = $res['post_title'];
            $post_catigory_id = $res['post_catigory_id'];
            $post_status = $res['post_status'];
            $post_image = $res['post_image'];
            $post_content = $res['post_content'];
            $post_tag = $res['post_tag'];
            $post_comment_count = $res['post_comment_count'];
            $post_date = $res['post_date'];
            $post_view_count=$res['post_view_count'];

            echo "<tr>";
           // echo " <td>$post_id</td>";
            echo " <td>$post_author</td>";

            if($post_status=="DRAFT")
            {
                echo " <td>$post_title</td>";
            }else{
            echo " <td>"."<a href=../post.php?id=".$post_id.">".$post_title."</a></td>";}



            $query_catid=" select name from navigation where id=$post_catigory_id; ";
            $result_catid=mysqli_query($connection,$query_catid);
            while($res_catid=mysqli_fetch_assoc($result_catid))
            {
                $temp=$res_catid['name'];
                echo "<td>$temp</td>";
            }                             
            
            
            echo " <td>$post_status</td>";
            echo " <td ><img width=100  src=" . "'../image/" . "$post_image'></td>";
            //echo " <td>$post_content</td>";
            echo " <td>$post_tag</td>";
            echo " <td>$post_comment_count</td>";
            echo "<td>$post_view_count</td>";
            //echo " <td>$post_date</td>";
            echo " <td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \" href='all_post.php?id=" . $post_id . "'>Delete</a>"."  "."<a href='all_post_edit.php?id=" . $post_id . "'>    Edit</a>" ."  "."<a href='all_post.php?view_id=" . $post_id . "'>   Reset Views</a>" . "</td> ";
            

            echo "</tr>";
        }

         ?>

        <?php 
        if (isset($_GET['id'])) {
            $post_id = $_GET['id'];
            $query_todelete = " delete from posts where post_id=$post_id; ";
            $result=mysqli_query($connection, $query_todelete);
            $querry_todeletecomment= " delete from comments where comment_post_id=$post_id; ";
            mysqli_query($connection,$querry_todeletecomment);
            header("Location: all_post.php");        
        }
        ?>
        <?php 
        if (isset($_GET['view_id'])) {
            $post_id = $_GET['view_id'];
            $query_toreset = " update posts set post_view_count=0 where post_id=$post_id; ";
            $result=mysqli_query($connection, $query_toreset);
            header("Location: all_post.php");        
        }
        ?>




 </a>



    </tbody>
</table>