<?php

   session_start();
   $profId = $_SESSION['id'];
?>
<?php if(!empty($_SESSION)) : ?>
<?php
      include './connect.php';

      $postId = $_POST['postId'];                    
       
      $CommentCount =  mysqli_query($con, "SELECT * FROM comments c JOIN users_info i ON c.user_id = i.user_id WHERE c.post_id = '$postId' ORDER BY c.created_at DESC;");
?>    
    <span><?php echo mysqli_num_rows($CommentCount) ?></span>
<?php else : 
      header('location:login.php');
      exit();
?>
<?php endif; ?>