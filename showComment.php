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

        $CommentCount =  mysqli_query($con, "SELECT * FROM comments c JOIN users_info i ON c.user_id = i.user_id WHERE c.post_id = '$postId' ORDER BY c.created_at DESC;");
        $x = floor(mysqli_num_rows($CommentCount) / 4);

        $query = mysqli_query($con, "SELECT * FROM users_posts p JOIN users_info i ON p.user_id = i.user_id WHERE `post_id` = '$postId';");
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $postProfileImg = $row['profile_img'];
        $desc = $row['description'];
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/showcomment.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 content pt-2 shadow">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-center justify-content-between">
                            <h3>comments</h3>
                            <a onclick="goBack()" style="cursor: pointer;">
                                <svg class="feather feather-x" fill="none" height="40" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                 viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/>
                                </svg>
                            </a>
                        </div>
                        <div class="col-lg-12 profInfo pt-3 pb-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-3">
                                        <?php if($profId == $row['user_id']) : ?>
                                            <a href="./profile.php" class="d-flex justify-content-around">
                                                <img src="./assets/images/<?php echo $postProfileImg ?>" alt="" class="rounded-pill">
                                            </a>
                                        <?php else : ?>
                                            <a href="./otherProfile.php?id=<?php echo $row['user_id'] ?>" class="d-flex justify-content-around">
                                                <img src="./assets/images/<?php echo $postProfileImg ?>" alt="" class="rounded-pill">
                                            </a>
                                        <?php endif; ?>                     
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-9 d-flex flex-column">
                                        <p class="fw-bold">
                                            <?php if($profId == $row['user_id']) : ?>
                                                <a href="./profile.php" class="text-decoration-none"><?php echo $row['user_name'] ?>
                                            <?php else : ?>
                                                <a href="./otherProfile.php?id=<?php echo $row['user_id'] ?>" class="text-decoration-none"><?php echo $row['user_name'] ?>
                                            <?php endif; ?>                     
                                                </a>
                                        </p>
                                        <p class="col-5 ps-2"><?php echo $desc ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <hr>                     
                        <div class=" col-lg-12">
                            <div class="container">
                                <div class="commentContent col-lg-12">
                                </div>
                                <div class="commentDiv row pb-2">
                                    <!-- <p class="more pt-3 pb-3" style="cursor: pointer;">See more</p> -->
                                    <form class="formComment d-flex align-items-center">
                                        <div class="col-lg-11 col-md-11 col-10">
                                            <input type="text" name="comment" placeholder="Add a comment for <?php echo $row['user_name']; ?>..." 
                                            style="width: 100%; background-color: transparent; color: var(--secondary-color);" class="comment border-0 py-2 px-2">
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-2">
                                            <button class="commentBtn border-0 py-2 px-2" style="color: blue; background-color: transparent;">Post</button>
                                            <input type="hidden" class="idValue" value="<?php echo $postId ?>">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</body>

<script>

    $(document).ready(function() {

        function loadData() {

            var commentDiv = $(".commentDiv");
            var postId = $(".idValue").val();
            // var countComment = 4;

            // $(".more").click(function getCount() {
            //     // countComment = countComment + 4;
            //     $.ajax({
            //         url: 'selectComment.php',
            //         type: 'POST',
            //         data: {postId: postId},
            //         success: function(getData) {
            //             $(".commentContent").html(getData);
            //         },
            //     })   
            // })
            
            $.ajax({
                url: 'selectComment.php',
                type: 'POST',
                data: {postId: postId},
                success: function(getData) {
                    $(".commentContent").html(getData);
                },
            })                                      
        }
        loadData();
        $(document).on("click", ".commentBtn", function(event) {
            event.preventDefault();
            var postId = $(".idValue").val();
            var comment = $(".comment").val();
            var form = $(".formComment");

            $.ajax({
                url: 'commentAction.php',
                type: 'POST',
                data: {comment: comment, postId: postId},
                success: function(data) {
                    if(data == 1) {
                        loadData();
                        form.trigger("reset");
                    }
                },
            })

        });
        deleteComment();
        function deleteComment() {
            $(document).on("click", ".deleteComment", function(event) {
                event.preventDefault();
                var commentElement = $(this).closest(".commentContent");
                var commentId = commentElement.find(".commentId").val();
                //   console.log(commentId);
                $.ajax({
                    url: 'deleteComment.php',
                    type: 'POST',
                    data: {commentId: commentId},
                    success: function(data) {
                        if(data == 1) {
                            commentElement.addClass("hide");
                        }
                    }
                })
            });
        }
    })

</script>
<script>
    let Mode = window.localStorage.getItem("Mode");

    if (Mode === "dark") {

        document.body.classList.toggle("dark-theme");

    }

// let clickSeeMoreCount = document.querySelector(".more");
// let SeeMoreCount = 0;
// let x = <?php 
// echo $x 
?>;

// if(x == 0 || <?php 
// echo (mysqli_num_rows($CommentCount) / 4) 
?> == 1) {
//     clickSeeMoreCount.style.cssText = "display: none; visibility: hidden;";
// } else {

//     clickSeeMoreCount.addEventListener("click", () => {
//     SeeMoreCount++;
//     if(SeeMoreCount <= x - 1) {
//         clickSeeMoreCount.style.cssText = "cursor: pointer;";
//     } else {
//         clickSeeMoreCount.style.cssText = "display: none; visibility: hidden;";
//     }

//    })
// }

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