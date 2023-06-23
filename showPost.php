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
    if(isset($_GET['post_img'])) {

        $postImg = $_GET['post_img'];

        $query = mysqli_query($con, "SELECT * FROM users_posts p JOIN users_info i ON p.user_id = i.user_id WHERE `post_img` = '$postImg' AND i.user_email = '$profEmail';");
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $desc = $row['description'];
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
    <link rel="stylesheet" href="./assets/css/showPost.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row pt-3 pb-3">
            <div class="xBtnPhone">
                <div class="row">
                    <div class="col-10"></div>
                    <a class="col-2 text-center" onclick="goBack()">
                        <svg class="feather feather-x" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 col-12">
                <nav class="navbar content">
                    <div class="container">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-11 col-md-11 col-10">
                                <a href="./profile.php"><img src="<?php echo $profImg ?>" class="profImg rounded-pill"></a>
                                <span class="pt-2 fw-bold"><a href="./profile.php" class="text-decoration-none"><?php echo $profName ?></a></span>
                            </div>
                            <div class="col-lg-1 col-md-1 col-2 text-center">
                                <a class="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg class="svg" enable-background="new 0 0 32 32" id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" 
                                    xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M29,16c0,1.104-0.896,2-2,2H11c-1.104,0-2-0.896-2-2s0.896-2,2-2h16C28.104,14,29,14.896,29,16z" id="XMLID_352_"/>
                                    <path d="M29,6c0,1.104-0.896,2-2,2H11C9.896,8,9,7.104,9,6s0.896-2,2-2h16C28.104,4,29,4.896,29,6z" id="XMLID_354_"/>
                                    <path d="M29,26c0,1.104-0.896,2-2,2H11c-1.104,0-2-0.896-2-2s0.896-2,2-2h16C28.104,24,29,24.896,29,26z" id="XMLID_356_"/>
                                    <path d="M3,6c0,1.103,0.897,2,2,2s2-0.897,2-2S6.103,4,5,4S3,4.897,3,6z" id="XMLID_358_"/><path d="M3,16c0,1.103,0.897,2,2,2s2-0.897,2-2s-0.897-2-2-2S3,14.897,3,16z" id="XMLID_360_"/>
                                    <path d="M3,26c0,1.103,0.897,2,2,2s2-0.897,2-2s-0.897-2-2-2S3,24.897,3,26z" id="XMLID_362_"/>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="text-center">
                                        <form action="./deletePostAction.php?post_img=<?php echo $postImg ?>" method="POST">
                                            <input type="submit" name="deletePost" value="Delete" class="border-0 py-2">
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="text-center">
                                        <a id="editBtn"><button class="editBtn border-0 py-2">Edit</button></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="xBtn col-lg-1 col-md-1 pt-4">
                <a onclick="goBack()" style="cursor: pointer;">
                    <svg class="feather feather-x" fill="none" height="40" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    viewBox="0 0 24 24" width="35" xmlns="http://www.w3.org/2000/svg"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/>
                    </svg>
                </a>
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8">
                <img src="./assets/images/<?php echo $postImg ?>" alt="" class="postImg">
            </div>
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8">
                <div class="content container py-2">
                    <div class='pt-2 d-flex gap-3'>
                        <div class="likeDiv d-flex flex-column align-items-center gap-1">
                            <?php 
                                $idPost = $row['post_id'];
                                $selectLikes =  mysqli_query($con, "SELECT * FROM likes WHERE user_id = '$profId' AND post_id = '$idPost';");
                                if(mysqli_num_rows($selectLikes) > 0) {
                                    $statusLike = mysqli_fetch_array($selectLikes);
                                    $isLiked = $statusLike['likeStatus'] == 1;
                                    $class = $isLiked ? 'svgLikedColor' : ''; 
                                } else {
                                    $class = '';
                                }
                            ?>
                            <svg class='svgLike' width="33" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path class='svgLikeColor <?php echo $class; ?>' d="M15 8C8.92487 8 4 12.9249 4 19C4 30 17 40 24 42.3262C31 40 44 30 44 19C44 12.9249 39.0751 8 33 8C29.2797 8 25.9907 9.8469 24 12.6738C22.0093 9.8469 18.7203 8 15 8Z" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                            </svg>
                            <input type="hidden" class="likeIdValue" value="<?php echo $postId = $row['post_id'] ?>">
                            <a href="./showLikes.php?post_id=<?php echo $postId ?>" class="likeCount text-decoration-none" style="color: var(--secondary-color); cursor: pointer; font-size: 14px;"></a>
                        </div>
                        <div class="" style="padding-top: 3px;">
                            <a href='./showComment.php?post_id=<?php echo $postId = $row['post_id'] ?>' class='text-decoration-none'>
                                <svg width="33" viewBox='0 0 28 28' xmlns='http://www.w3.org/2000/svg'><path clip-rule='evenodd' d='M11.0297 3.92593C6.55413 3.92593 2.92593 7.55413 2.92593 12.0298C2.92593 16.5054 6.55413 20.1336 11.0297 20.1336H16.9703C17.1482 20.1336 17.3247 20.1279 17.4995 20.1166C17.8151 20.0963 18.1346 20.195 18.3872 20.4064L21.2349 22.7897C21.3651 22.8987 21.5633 22.8061 21.5633 22.6364V19.3368C21.5633 18.9472 21.7438 18.5898 22.035 18.3564C23.8894 16.8696 25.0741 14.5884 25.0741 12.0298C25.0741 7.55413 21.4459 3.92593 16.9703 3.92593H11.0297ZM1 12.0298C1 6.49047 5.49047 2 11.0297 2H16.9703C22.5095 2 27 6.49047 27 12.0298C27 15.0808 25.6366 17.8141 23.4892 19.6522V24.5077C23.4892 25.5703 22.2488 26.1497 21.4339 25.4677L17.353 22.0523C17.226 22.0571 17.0984 22.0595 16.9703 22.0595H11.0297C5.49047 22.0595 1 17.569 1 12.0298Z' fill='var(--secondary-color)' fill-rule='evenodd'/></svg>
                            </a>
                        </div>
                    </div>
                    <div class="pt-4">
                        <span class="desc" style="color: var(--secondary-color)"><?php echo $desc ?></span>
                        <div class="editForm hide">
                            <div class="row d-flex align-items-center justify-content-around">
                                <button class="cancelEdit col-2">cancel</button>
                                <form action="./deletePostAction.php?post_img=<?php echo $postImg ?>" method="post" class="col-10 py-3 d-flex align-items-center justify-content-around">
                                    <textarea name="desc" placeholder="<?php 
                                    if(!empty($desc)) {
                                         echo $desc;
                                    } else {
                                        echo "add description";
                                    }?>" 
                                    class="py-1 px-2" rows="1"></textarea>
                                    <input type="submit" name="done" value="done" class="p-2">
                                </form>
                            </div>
                        </div>
                        <div class="commentDiv pt-4 pb-2">
                                <div>
                                    <a href="./showComment.php?post_id=<?php echo $postId = $row['post_id'] ?>" class="text-decoration-none">
                                        <span style="color: var(--secondary-color); opacity: 0.7;">show all <span class="countComment"></span> comments</span>
                                    </a>
                                </div>
                                <form class="formComment d-flex align-items-center pt-2">
                                    <div class="col-lg-11 col-md-11 col-10">
                                        <input type="text" name="comment" placeholder="Add a comment..." style="width: 100%; background-color: transparent; color: var(--secondary-color);" class="comment border-0 py-2">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-2">
                                        <button class="commentBtn border-0 py-2 px-2" style="color: blue; background-color: transparent;">Post</button>
                                        <input type="hidden" class="idValue" value="<?php echo $postId = $row['post_id'] ?>">
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
</body>

<script>

    $(document).ready(function() {
        function loadData() {
            
            var postId = $(".idValue").val();
                
            $.ajax({
                url: 'countComment.php',
                type: 'POST',
                data: {postId: postId},
                success: function(getData) {
                    $(".countComment").html(getData);
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
                        alert('done');
                        form.trigger("reset");
                    } else {
                        alert('not match');
                    }
                },
            })

        });
    });
//=================================================================
$(document).ready(function() {
        function loadLike() {

                var postId = $(".likeIdValue").val();

                $.ajax({
                    url: 'selectLike.php',
                    type: 'POST',
                    data: {postId: postId},
                    success: function(getData) {
                        $(".likeCount").html(getData);
                    },
                })                                 
        }
        loadLike();

        $(document).on("click", ".svgLike", function(event) {
            event.preventDefault();

            var svgLikeColor = $(".svgLikeColor");
            svgLikeColor.toggleClass("svgLikedColor");

            var status = svgLikeColor.hasClass("svgLikedColor"); 

            console.log(status);

            var postId = $(".likeIdValue").val();

            $.ajax({
                url: 'likeAction.php',
                type: 'POST',
                data: {postId: postId, status: status},
                success: function(data) {
                    loadLike();
                },
            })

        });
    }); 
</script>

<script>
let Mode = window.localStorage.getItem("Mode");

if(Mode === "dark") {
    
    document.body.classList.toggle("dark-theme");

}

let editBtn = document.getElementById("editBtn");
let editForm = document.querySelector(".editForm");
let desc = document.querySelector(".desc");
let cancelEdit = document.querySelector(".cancelEdit");





editBtn.addEventListener("click", () => {
    desc.classList.add("hide");
    editForm.classList.remove("hide");
})
cancelEdit.addEventListener("click", () => {
    desc.classList.remove("hide");
    editForm.classList.add("hide");
})

let commentSvg = document.querySelector(".commentSvg");
let commentInput = document.querySelector(".commentInput");

commentSvg.addEventListener("click", () => {
    setTimeout(() => {
        commentInput.style.cssText = "background-color: var(--tertiary-color); width: 100%;";
    }, 0)
    setTimeout(() => {
        commentInput.style.cssText = "background-color: transparent; width: 100%;";
    }, 2000)
})

function goBack() {
    window.history.back();
}
</script>

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