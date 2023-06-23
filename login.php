<?php

include './connect.php';

if(isset($_POST["submit"])) {

    session_start(); 

    $email = $_POST["email"];
    $password = $_POST["password"];

    $verify_email_password = mysqli_query($con, "SELECT user_email, password FROM users_info WHERE user_email = '$email' AND password = '$password';");

    if(!empty($email) && !empty($password) && mysqli_num_rows($verify_email_password) != 0) {

        $res = mysqli_query($con, "SELECT user_id, user_name, profile_img FROM users_info WHERE user_email = '$email';");
        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
        $_SESSION["id"] = $result[0]['user_id'];
        $_SESSION["username"] = $result[0]['user_name'];
        $_SESSION["email"] = $email;
        $_SESSION["image"] = './assets/images/' . $result[0]['profile_img'];

        header('location:Home.php');
        exit();          
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
    <title>login</title>
</head>
<body>
    <div class="container mt-5 pt-3">
        <div class="row mt-5 pt-5">
            <div class="col-lg-1"></div>
            <div class="col-lg-4 col-md-5">
                <img src="./assets/images/animation_500_lhrx39qo.gif" alt="">
            </div>
            <div class="col-lg-1 col-md-1 col-1"></div>
            <div class="col-lg-4 col-md-6 col-10 mt-4">
                <form action="./login.php" method="POST" name="form" class="shadow p-4">
                    <h3 class="text-center">MediaApp</h3>
                    <div class="form-group mt-4">  
                        <input type="email" name="email" placeholder="Email" class="form-control py-2">
                        <span id="errorEmail"></span>
                        <?php
                          if(isset($_POST["submit"])) {
                            if(empty($email)){
                                echo "<span style='color: red;'>Enter your email</span>";
                            } else if(mysqli_num_rows($verify_email_password) == 0) {
                                echo "<span style='color: red;'>Wrong email</span>";
                            }
                          }
                         ?>
                    </div>
                    <div class="form-group mt-4"> 
                        <input type="password" name="password" placeholder="Password" class="form-control py-2">
                        <span id="errorPassword"></span>
                        <?php
                          if(isset($_POST["submit"])) {
                            if(empty($password)){
                                echo "<span style='color: red;'>Enter your password</span>";
                            } else if(mysqli_num_rows($verify_email_password) == 0) {
                                echo "<span style='color: red;'>Wrong password!</span>";
                            }
                          }
                         ?>
                    </div>
                    <div class="form-btn mt-4"> 
                        <input type="submit" name="submit" value="Login" class="btn btn-primary px-5">
                        <p class="pt-1">you don't have an account? <a href="./register.php">Register</a></p>
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