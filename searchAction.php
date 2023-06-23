<?php
    include './connect.php';

     session_start();

     $profId = $_SESSION['id'];
     $profName = $_SESSION['username'];
     $profImg = $_SESSION['image'];
     $profEmail = $_SESSION["email"];
?>
<?php if(!empty($_SESSION)) : ?>
<?php
     if(isset($_POST['query'])) {

        $search = $_POST['query'];

        if(!empty($search)) {
            $getRes = mysqli_query($con, "SELECT * FROM users_info WHERE user_name LIKE '%$search%';");

            while($row = mysqli_fetch_array($getRes)) {
?>
                <div class="container py-2">
                    <div class="row d-flex align-items-center">
                    <?php if($row['user_id'] == $profId) : ?>
                        <div class="col-lg-1 col-md-2 col-3 d-flex align-items-center">
                            <a href="./profile.php">
                                <img src="./assets/images/<?php echo $row['profile_img'] ?>" class="rounded-pill" style="width: 100%;">
                            </a>
                        </div>
                        <div class="col-lg-10 col-md-10 col-9 d-flex align-items-center">
                            <a href="./profile.php" class="text-decoration-none ms-2" style="color: var(--secondary-color);">
                                <?php echo $row['user_name'] ?>
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="col-lg-1 col-md-2 col-3 d-flex align-items-center">
                            <a href="./otherProfile.php?id=<?php echo $row['user_id'] ?>">
                                <img src="./assets/images/<?php echo $row['profile_img'] ?>" class="rounded-pill" style="width: 100%;">
                            </a>
                        </div>
                        <div class="col-lg-10 col-md-10 col-9 d-flex align-items-center">
                            <a href="./otherProfile.php?id=<?php echo $row['user_id'] ?>" class="text-decoration-none ms-2" style="color: var(--secondary-color);">
                                <?php echo $row['user_name'] ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
<?php       }
        }

    }
?>
<?php else :
    header('location:login.php');
    exit();
?>
<?php endif; ?>