<?php

   session_start();

?>

<?php if(!empty($_SESSION)) : ?>

<?php 
    include './connect.php';

    
    $profId = $_SESSION['id'];

    $commentId = $_POST['commentId'];

    $deleteComment =  mysqli_query($con, "DELETE FROM `comments` WHERE `comment_id` = '$commentId';");
    if ($deleteComment) {
        echo 1;
      } else {
        echo mysqli_error($con);
      }
?>

<?php else :
    header('location:login.php');
    exit();
?>
<?php endif; ?>
