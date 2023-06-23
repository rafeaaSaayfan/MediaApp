<?php

   session_start();
   $profId = $_SESSION['id'];

   if(!empty($_SESSION)) {

      include './connect.php';

      $postId = $_POST['postId'];
      $comment = $_POST['comment'];     
                        
      if (!empty($comment)) {
         $insertComment =  "INSERT INTO comments (post_id, user_id, comment, created_at) VALUES ('$postId', '$profId', '$comment', NOW());";
         
         if (mysqli_query($con, $insertComment)) {
           echo 1;
         } else {
           echo mysqli_error($con);
         }
       }
       
   } else {
      header('location:login.php');
      exit();
   }

?>