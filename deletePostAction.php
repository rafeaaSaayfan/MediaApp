<?php 

include './connect.php';

if(isset($_POST['deletePost'])) {
    session_start();
    $profEmail = $_SESSION["email"];

    $postImg = $_GET['post_img'];

    mysqli_query($con, "DELETE p FROM users_posts p JOIN users_info i ON p.user_id = i.user_id WHERE p.post_img = '$postImg' AND i.user_email = '$profEmail';");

    header('location:profile.php');
    exit();
    
 }
 if(isset($_POST['done'])) {

    session_start();
    $profEmail = $_SESSION["email"];

    $postImg = $_GET['post_img'];

    $desc = $_POST['desc'];

    mysqli_query($con, "UPDATE users_posts p JOIN users_info i ON p.user_id = i.user_id SET p.description = '$desc' WHERE p.post_img = '$postImg' AND i.user_email = '$profEmail';");

    header('location:showPost.php?post_img=' . $postImg);
    exit();

 }


?>