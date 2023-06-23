<?php

   session_start();
   $profId = $_SESSION['id'];

   if(!empty($_SESSION)) {

      include './connect.php';

      $postId = $_POST['postId'];  
      $status = $_POST['status'];   
      if($status == true) {
        $status = 1;
      } else {
        $status = 0;
      }    

      $selectLikes =  mysqli_query($con, "SELECT * FROM likes WHERE post_id = '$postId' AND user_id = '$profId';");
        if(mysqli_num_rows($selectLikes) > 0) {
            $row = mysqli_fetch_array($selectLikes);

            if($row['likeStatus'] == 1) {
                $update =  "UPDATE `likes` SET `likeStatus`= 0 WHERE `user_id`= '$profId' AND `post_id`= '$postId';";
         
                if (mysqli_query($con, $update)) {
                    echo "update to 0";
                } else {
                    echo mysqli_error($con);
                }

            } else {
                $update =  "UPDATE `likes` SET `likeStatus`= 1 WHERE `user_id`= '$profId' AND `post_id`= '$postId';";
         
                if (mysqli_query($con, $update)) {
                    echo "update to 1";
                } else {
                    echo mysqli_error($con);
                }
            }
        } else {
            $insertLike =  "INSERT INTO likes (post_id, user_id, likeStatus) VALUES ('$postId', '$profId', '$status');";

            if (mysqli_query($con, $insertLike)) {
                echo "insert";
            } else {
                echo mysqli_error($con);
            }
        }
       
   } else {
      header('location:login.php');
      exit();
   }

?>