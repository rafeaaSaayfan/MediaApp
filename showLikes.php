<?php
include './connect.php';

session_start();
$profId = $_SESSION['id'];
$profName = $_SESSION['username'];
$profImg = $_SESSION['image'];
$profEmail = $_SESSION["email"];
?>
<?php if (!empty($_SESSION)) : ?>
    <?php
    if (isset($_GET['post_id'])) {

        $postId = $_GET['post_id'];

        $selectLiked = mysqli_query($con, "SELECT * FROM users_info i JOIN likes l ON i.user_id = l.user_id WHERE l.post_id = '$postId' AND l.likeStatus = 1 ORDER BY l.like_id DESC;");

    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <title>Document</title>
</head>
<style>
    :root
{
    --primary-color: #fff;
    --secondary-color: #000;
    --tertiary-color: #ddd5d584;
    --quaternary-color:  #ddd5d5;
}
.dark-theme
{
    --primary-color: #000;
    --secondary-color: #fff;
    --tertiary-color: #ddd5d584;
    --quaternary-color:  #ddd5d5;
}
    body
    {
        background-color: var(--quaternary-color);
    }
    .content
    {
        background-color: var(--primary-color);
        min-height: 100vh;
    }
    h3, hr, svg
    {
        color: var(--secondary-color);
    }
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="content col-lg-6 pt-2 shadow">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-center justify-content-between pb-3 pt-3">
                            <h3>likes</h3>
                            <a onclick="goBack()" style="cursor: pointer;">
                                <svg class="feather feather-x" fill="none" height="40" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                 viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/>
                                </svg>
                            </a>
                        </div>
                        <hr>
                        <?php while($row = mysqli_fetch_array($selectLiked)) { ?>

                            <div class="profInfo col-lg-12 py-2">
                                <div class="container">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-lg-2 col-md-2 col-3 d-flex align-items-center">
                                            <?php if($profId == $row['user_id']) : ?>
                                                <a href="./profile.php" class="d-flex justify-content-around">
                                                    <img src="./assets/images/<?php echo $row['profile_img'] ?>" style="width: 70%;" class="rounded-pill"></a>
                                            <?php else : ?>
                                                <a href="./otherProfile.php?id=<?php echo $row['user_id'] ?>" class="d-flex justify-content-around">
                                                    <img src="./assets/images/<?php echo $row['profile_img'] ?>" style="width: 70%;" class="rounded-pill"></a>
                                            <?php endif; ?>                   
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-9 d-flex align-items-center">
                                            <p class="fw-bold">
                                            <?php if($profId == $row['user_id']) : ?>
                                                <a href="./profile.php" class="text-decoration-none" style="color: var(--secondary-color);">
                                                    <?php echo $row['user_name'] ?>
                                            <?php else : ?>
                                                <a href="./otherProfile.php?id=<?php echo $row['user_id'] ?>" class="text-decoration-none" style="color: var(--secondary-color);">
                                                    <?php echo $row['user_name'] ?>
                                            <?php endif; ?>                     
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</body>

<script>


</script>
<script>
    let Mode = window.localStorage.getItem("Mode");

    if (Mode === "dark") {

        document.body.classList.toggle("dark-theme");

    }

function goBack() {
    window.history.back();
}

</script>

    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php else :
    header('location:login.php');
    exit();
?>
<?php endif; ?>

    </html>