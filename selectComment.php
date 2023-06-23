<?php

   session_start();

?>

<?php if(!empty($_SESSION)) : ?>

      <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<?php
      include './connect.php';

      $profId = $_SESSION['id'];

      // $count = $_POST['countComment'];
      $postId = $_POST['postId'];

      $userIdOfPost = mysqli_fetch_array(mysqli_query($con, "SELECT user_id FROM users_posts WHERE post_id = '$postId';"))[0];
      
      $selectComment =  mysqli_query($con, "SELECT * FROM comments c JOIN users_info i ON c.user_id = i.user_id WHERE c.post_id = '$postId' ORDER BY c.created_at DESC;");
      if(mysqli_num_rows($selectComment) > 0) {
        
        while($row = mysqli_fetch_array($selectComment)) {
?>

<div class="row commentContent">      
      <div class="col-lg-2 col-md-2 col-3 pt-1 pb-4">
            <?php if($profId == $row['user_id']) {
                  echo "<a href='./Profile.php' class='d-flex justify-content-around text-decoration-none'>";
            } else {
                  echo "<a href='./otherProfile.php?id=" . $row['user_id'] . "' class='d-flex justify-content-around text-decoration-none'>";
            }
            ?>
                  <img src='./assets/images/<?php echo $row['profile_img'] ?>' class='rounded-pill' style='width: 80%;'>
            </a>
      </div>
      <div class="col-lg-10 col-md-10 col-9 ps-2 pt-1 pb-4 d-flex align-items-center justify-content-between">
            <div class="">
                  <p class='profNames fw-bold'>
                  <?php if($profId == $row['user_id']) {
                        echo "<a href='./Profile.php' class='text-decoration-none' style='font-size: 14px;'>";
                  } else {
                        echo "<a href='./otherProfile.php?id=" . $row['user_id'] . "' class='text-decoration-none' style='font-size: 14px;'>";
                  }
                  ?>
                              <?php echo $row['user_name'] ?>
                        </a>
                  </p>
                  <p class='' style='font-size: 14px;'><?php echo $row['comment'] ?></p>
            </div>
            <?php if($profId == $row['user_id'] || $profId == $userIdOfPost) : ?>
                  <svg style="enable-background:new 0 0 24 24; width: 4%; fill: var(--secondary-color); cursor: pointer;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" 
                  xmlns:xlink="http://www.w3.org/1999/xlink" class="deleteComment"><g id="info"/><g id="icons"><g id="delete">
                  <path d="M18.9,8H5.1c-0.6,0-1.1,0.5-1,1.1l1.6,13.1c0.1,1,1,1.7,2,1.7h8.5c1,0,1.9-0.7,2-1.7l1.6-13.1C19.9,8.5,19.5,8,18.9,8z"/>
                  <path d="M20,2h-5l0,0c0-1.1-0.9-2-2-2h-2C9.9,0,9,0.9,9,2l0,0H4C2.9,2,2,2.9,2,4v1c0,0.6,0.4,1,1,1h18c0.6,0,1-0.4,1-1V4    C22,2.9,21.1,2,20,2z"/>
                  </g></g></svg>
                  <input type="hidden" class="commentId" value="<?php echo $row['comment_id'] ?>">
            <?php endif; ?>
      </div>
</div>


<?php }
}  else {
      echo "<p class='py-3' style='color: var(--secondary-color); opacity: 0.8;'>There is no a comment</p>";
}
 ?>
<script>

</script>
<?php else :
      header('location:login.php');
      exit();
?>
<?php endif; ?>