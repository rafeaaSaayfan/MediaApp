<?php

   session_start();

?>

<?php if(!empty($_SESSION)) : ?>

<?php
      include './connect.php';

      $profId = $_SESSION['id'];
      $postId = $_POST['postId'];

      $selectLikes =  mysqli_query($con, "SELECT * FROM likes l JOIN users_info i ON l.user_id = i.user_id WHERE l.post_id = '$postId' AND l.likeStatus = 1 ORDER BY l.like_id DESC;");
  
      $count = mysqli_num_rows($selectLikes);
      if(mysqli_num_rows($selectLikes) > 0) {
?>
          <span><?php echo $count ?> Likes</span>
<?php
} else {
      echo "<span>0</span>";
}
 ?>

<?php else :
      header('location:login.php');
      exit();
?>
<?php endif; ?>