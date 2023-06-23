<?php

include './connect.php';

if(isset($_POST["submit"])) {

    session_start();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confPassword = $_POST["confirm_password"];

    $fileName = $_FILES["file"]["name"];
    $filetmpname = $_FILES["file"]["tmp_name"];
    $folder = './assets/images/';
    move_uploaded_file($filetmpname, $folder . $fileName);

    $_SESSION['username'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['image'] = $folder . $fileName;


    $verify_email = mysqli_query($con, "SELECT user_email FROM users_info WHERE user_email = '$email';");

    if(!empty($name) && !empty($email) && !empty($password) && !empty($confPassword) && !empty($fileName) && strlen($name) >= 7 && 
       mysqli_num_rows($verify_email) == 0 && strlen($password) >= 7 && $password = $confPassword) {

        $imageSize = getimagesize($folder . $fileName);
        $width = $imageSize[0];
        $height = $imageSize[1];
        $imageType = $imageSize["mime"]; 

        if($imageType == "image/png" || $imageType == "image/jpeg" || $imageType == "image/jpg") {

          $sql = "INSERT INTO users_info (user_name, user_email, password, profile_img, date_time) VALUES ('$name', '$email', '$password', '$fileName', NOW());";
          mysqli_query($con, $sql);
          $getId = mysqli_query($con, "SELECT user_id FROM users_info WHERE user_email = '$email'");
          $getId = mysqli_fetch_all($getId, MYSQLI_ASSOC);
          $_SESSION["id"] = $getId[0]['user_id'];
          header('location:Home.php');
          exit();

        }
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <link rel="stylesheet" href="./assets/css/reg&log_style.css">
    <title>register</title>
</head>
<body>
    <div class="container mt-5 pb-md-5">
        <div class="row mt-lg-5 pt-lg-5">
            <div class="col-lg-1"></div>
            <div class="col-lg-4 col-md-5 mt-5">
                <img src="./assets/images/animation_500_lhrx39qo.gif" alt="">
            </div>
            <div class="col-lg-1 col-md-1 col-1"></div>
            <div class="col-lg-4 col-md-6 col-10 pb-5">
                <form action="./register.php" method="POST" name="form" enctype="multipart/form-data" class="shadow p-4">
                    <h3 class="text-center">MediaApp</h3>
                    <div class="form-group mt-3">
                        <input type="name" placeholder="Name" name="name" class="form-control py-2">
                        <?php
                          if(isset($_POST["submit"])) {
                            if(empty($name)){
                                echo "<span style='color: red;'>Enter your name</span>";
                            } else if(strlen($name) < 7) {
                                echo "<span style='color: red;'>Your name must be at least 7 characters</span>";
                            }
                          }
                         ?>
                    </div>
                    <div class="form-group mt-4">  
                        <input type="email" name="email" placeholder="Email" class="form-control py-2">
                        <?php
                          if(isset($_POST["submit"])) {
                            if(empty($email)){
                                echo "<span style='color: red;'>Enter your email</span>";
                            } else if(mysqli_num_rows($verify_email) != 0) {
                                echo "<span style='color: red;'>This email is already used, please login</span>";
                            }
                          }
                         ?>
                    </div>
                    <div class="form-group mt-4"> 
                        <input type="password" name="password" placeholder="Password" class="form-control py-2">
                        <?php
                          if(isset($_POST["submit"])) {
                            if(empty($password)){
                                echo "<span style='color: red;'>Enter your password</span>";
                            } else if(strlen($password) < 7) {
                                echo "<span style='color: red;'>Your password must be at least 7 characters</span>";
                            }
                          }
                         ?>
                    </div>
                    <div class="form-group mt-4"> 
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control py-2">
                        <?php
                          if(isset($_POST["submit"])) {
                            if(empty($confPassword)){
                                echo "<span style='color: red;'>Confirm your password</span>";
                            } else if($password != $confPassword) {
                                echo "<span style='color: red;'>Enter the same password</span>";
                            }
                          }
                         ?>
                    </div>
                    <div class="form-group mt-4"> 
                        <button class="inputPhoto px-3 pt-1 pb-2">
                            profile photo
                            <input type="file" name="file">
                        </button>
                        <?php
                            if(isset($_POST["submit"])) {
                                if(empty($fileName) || $imageType !== "image/png" || $imageType !== "image/jpeg" || $imageType !== "image/jpg"){
                                    echo "<br>" . "<span style='color: red;'>photo not match</span>";
                                } 
                            }                       
                        ?>
                    </div>
                    <div class="form-btn mt-4"> 
                        <input type="submit" name="submit" value="Register" class="btn btn-primary px-5">
                        <p class="pt-1">already have an account? <a href="./login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<!-- <script src="./assets/reg&log_js.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>