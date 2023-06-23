<?php
    include "./connect.php";

    session_start();
    $profID = $_SESSION['id'];
    $profImg = $_SESSION['image'];
?>
<?php if(!empty($_SESSION)) : ?>
<?php
    $imgName = mysqli_query($con, "SELECT profile_img FROM users_info WHERE user_id = '$profID';");
    $ImgName = mysqli_fetch_all($imgName, MYSQLI_ASSOC);
    
    if(isset($_POST['answerYES'])) {

        $path = 'assets/images/' . $ImgName[0]['profile_img'];
        if($ImgName[0]['profile_img'] != 'user_profile.webp') {
           unlink($path);
         }

        mysqli_query($con, "DELETE FROM users_info WHERE user_id = '$profID';");

        header('location:register.php');
        exit();
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
    <title>Document</title>
</head>
<body>
    <div class="container pt-5 mt-5">
        <div class="row pt-5 mt-5">
            <div class="col-lg-3"></div>
            <div class="content text-center col-lg-6 pt-5 shadow pb-5">
                <h5 class="">Are you sure do u want to delete your account?</h5>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-1"></div>
                    <div class="answer d-flex align-items-center pt-5 col-lg-6 col-md-6 col-10" style="justify-content: space-between">
                            <button class="shadow answerNo border-0 pt-1 pb-1 ps-4 pe-4" style="background-color: transparent; color: blue;">
                                <a class="text-decoration-none" href="./profile.php">NO</a>
                            </button>
                        <form action="" method="POST">
                            <input type="submit" name="answerYES" value="YES" class="shadow border-0 pt-1 pb-1 ps-4 pe-4 ms-lg-1" style="background-color: transparent; color: red;">
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-3 col-1"></div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php else :
    header('location:login.php');
    exit();
?>
<?php endif; ?>
</html>