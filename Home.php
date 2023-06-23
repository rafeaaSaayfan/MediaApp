<?php
   include './connect.php';

   session_start();
   $profId = $_SESSION['id'];
   $profImg = $_SESSION['image'];  
?>
<?php if(!empty($_SESSION)) : ?>
<?php
   $query = mysqli_query($con, "SELECT * FROM `users_info` i, `users_posts` p WHERE i.user_id = p.user_id ORDER BY p.created_at DESC;");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/HomeStyle.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="main-container">
        <div class="sidebar fixed-top" id="side_nav">
            <div class="header-box px-3 pt-3 pb-4">
                <h3 class="h3 pt-3">MediaApp</h3>
            </div>
            <div class="container d-flex flex-column justify-content-space-between">
                <a class="sideBarBtn p-3 d-flex gap-2 fw-bold text-decoration-none" href="./Home.php">
                    <svg fill="black" viewBox="0 0 16 16"
                    xmlns="http://www.w3.org/2000/svg"><path d="M1 6V15H6V11C6 9.89543 6.89543 9 8 9C9.10457 9 10 9.89543 10 11V15H15V6L8 0L1 6Z" /></svg>
                    <span>Home</span>
                </a>
                <a class="sideBarBtn p-3 d-flex gap-2 text-decoration-none" href="./search.php">
                    <svg enable-background="new 0 0 50 50" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <circle cx="21" cy="20" fill="none" r="16" stroke="var(--secondary-color)" stroke-linecap="round" stroke-miterlimit="10" stroke-width="3"/><line fill="red" stroke="var(--secondary-color)" stroke-miterlimit="10" stroke-width="4" x1="32.229" x2="45.5" y1="32.229" y2="45.5"/>
                    </svg>
                    <span>Search</span>
                </a>
                <a class="sideBarBtn p-3 d-flex gap-2 text-decoration-none" href="./addPost.php">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" d="M1 7C1 3.68629 3.68629 1 7 1H17C20.3137 1 23 3.68629 23 7V17C23 20.3137 20.3137 23 17 23H7C3.68629 23 1 20.3137 1 17V7ZM7 3C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7Z" fill-rule="evenodd"/>
                    <path clip-rule="evenodd" d="M11 18V6H13V18H11Z" fill-rule="evenodd"/><path clip-rule="evenodd" d="M18 13H6V11H18V13Z" fill-rule="evenodd"/></svg>
                    <span>Create</span>
                </a>
                <a class="sideBarBtn p-3 d-flex gap-2 text-decoration-none" href="#">
                <svg enable-background="new 0 0 32 32" id="Stock_cut" version="1.1" viewBox="0 0 32 32" xml:space="preserve" class="messaSvg"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc/><g>
                    <polygon fill="none" points="2,3 2,23 6,23    6,29 12,23 30,23 30,3  " stroke-linejoin="round" stroke-miterlimit="10" 
                    stroke-width="2"/><circle cx="8" cy="13" fill="none" r="2" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                    <circle cx="16" cy="13" r="2" fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                    <circle cx="24" cy="13" r="2" fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/></g></svg>
                    <span>Messages</span>
                </a>
                <a class="sideBarBtn p-3 d-flex gap-2 text-decoration-none" href="./profile.php">
                    <?php                     
                         echo "<img src='$profImg' class='rounded-pill'>";
                     ?>
                    <span>Profile</span>
                </a>
            </div>
            <hr style="color: var(--secondary-color);">
            <div class="container">
                <div class="nav-item dropdown">
                    <a class="sideBarBtn nav-link d-flex gap-2 align-items-center p-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg enable-background="new 0 0 32 32" id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path d="M26,16c0,1.104-0.896,2-2,2H8c-1.104,0-2-0.896-2-2s0.896-2,2-2h16C25.104,14,26,14.896,26,16z" id="XMLID_314_"/><path d="M26,8c0,1.104-0.896,2-2,2H8c-1.104,0-2-0.896-2-2s0.896-2,2-2h16C25.104,6,26,6.896,26,8z" id="XMLID_315_"/>
                        <path d="M26,24c0,1.104-0.896,2-2,2H8c-1.104,0-2-0.896-2-2s0.896-2,2-2h16C25.104,22,26,22.896,26,24z" id="XMLID_316_"/></svg>
                        <span>More</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item py-2" href="./editProfile.php">Setting</a></li>
                        <li id="colorMode">
                            <a class="dropdown-item d-flex gap-2 py-2">Mode 
                                <svg class="feather feather-sun sun" id="sun" style="width: 12%;" stroke="currentColor" stroke-linecap="round" 
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="5" fill="none"/><line x1="12" x2="12" y1="1" y2="3"/><line x1="12" x2="12" y1="21" y2="23"/>
                                <line x1="4.22" x2="5.64" y1="4.22" y2="5.64"/><line x1="18.36" x2="19.78" y1="18.36" y2="19.78"/>
                                <line x1="1" x2="3" y1="12" y2="12"/><line x1="21" x2="23" y1="12" y2="12"/><line x1="4.22" x2="5.64" y1="19.78" y2="18.36"/>
                                <line x1="18.36" x2="19.78" y1="5.64" y2="4.22"/></svg>

                                <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg" style="width: 12%;" class="hide" id="moon"><rect/>
                                <path d="M216.7,152.6A91.9,91.9,0,0,1,103.4,39.3h0A92,92,0,1,0,216.7,152.6Z" fill="none" stroke="#000" stroke-linecap="round" 
                                stroke-linejoin="round" stroke-width="16"/></svg>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2" href="./logout.php" style="color: red;">Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <nav class="navbar fixed-bottom">
                <div class="container d-flex align-items-center">
                    <svg fill="black" viewBox="0 0 16 16" class="navbarBtn"
                    xmlns="http://www.w3.org/2000/svg"><path d="M1 6V15H6V11C6 9.89543 6.89543 9 8 9C9.10457 9 10 9.89543 10 11V15H15V6L8 0L1 6Z" />
                    </svg>
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="navbarBtn">
                    <path d="M19,6 L19,4 L21,4 L21,6 L23,6 L23,8 L21,8 L21,10 L19,10 L19,8 L17,8 L17,6 L19,6 Z M6.93701956,5.8453758 C7.00786802,5.74688188 7.08655595,5.62630624 7.18689462,5.46372136 C7.24312129,5.37261385 7.44826978,5.03326386 7.48180256,4.97841198 C8.31078556,3.62238733 8.91339479,3 10,3 L15,3 L15,5 L10,5 C9.91327186,5 9.64050202,5.28172235 9.18819752,6.02158802 C9.15916322,6.06908141 8.95096113,6.41348258 8.88887147,6.51409025 C8.76591846,6.71331853 8.66374696,6.86987867 8.56061313,7.0132559 C8.1123689,7.63640757 7.66434207,8 7.0000003,8 L4,8 C3.44771525,8 3,8.44771525 3,9 L3,18 C3,18.5522847 3.44771525,19 4,19 L20,19 C20.5522847,19 21,18.5522847 21,18 L21,12 L23,12 L23,18 C23,19.6568542 21.6568542,21 20,21 L4,21 C2.34314575,21 1,19.6568542 1,18 L1,9 C1,7.34314575 2.34314575,6 4,6 L6.81619668,6 C6.84948949,5.96193949 6.89029794,5.91032846 6.93701956,5.8453758 Z M12,18 C9.23857625,18 7,15.7614237 7,13 C7,10.2385763 9.23857625,8 12,8 C14.7614237,8 17,10.2385763 17,13 C17,15.7614237 14.7614237,18 12,18 Z M12,16 C13.6568542,16 15,14.6568542 15,13 C15,11.3431458 13.6568542,10 12,10 C10.3431458,10 9,11.3431458 9,13 C9,14.6568542 10.3431458,16 12,16 Z" fill-rule="evenodd"/>
                    </svg>
                   <svg enable-background="new 0 0 32 32" id="Stock_cut" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" class="navbarBtn messaSvg" 
                    xmlns:xlink="http://www.w3.org/1999/xlink"><desc/><g><polygon fill="none" points="2,3 2,23 6,23    6,29 12,23 30,23 30,3  " 
                    fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><circle cx="8" cy="13" r="2" 
                    fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><circle cx="16" cy="13" r="2" 
                    fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><circle cx="24" cy="13" r="2" 
                    fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/></g>
                   </svg>
                   <?php
                    echo "<img src='$profImg' class='navbarBtn rounded-pill'>";
                   ?>
                </div>
            </nav>
            <div class="home container">
                <div class="row">
                    <div class="col-lg-3 col-md-2"></div>
                    <div class="col-lg-6 col-md-8">
                        <div class='container pb-5'>
                            <div class='row'>
                    <?php
                        while($getData = mysqli_fetch_array($query)) { 
                            echo "<div class='profinfo col-11 pt-3 pb-2'>";
                                if($profId == $getData['user_id']) {
                                    echo "<a href='./Profile.php' class='text-decoration-none'>";
                                } else {
                                    echo "<a href='./otherProfile.php?id=" . $getData['user_id'] . "' class='text-decoration-none'>";
                                }
                                    echo "<img src='" . "./assets/images/" . $getData['profile_img'] . " 'class='rounded-pill' style='width: 12%;'></a>";
                                if($profId == $getData['user_id']) {
                                    echo "<a href='./Profile.php' class='text-decoration-none'>";
                                } else {
                                    echo "<a href='./otherProfile.php?id=" . $getData['user_id'] . "' class='text-decoration-none'>";
                                }
                                    echo "<span class='profNames fw-bold ps-3'>" . $getData['user_name'] . "</span></a>";
                            echo "</div>";
                        ?> 
                            <div class="col-1 d-flex align-items-center">
                                <a class="menu-post" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg enable-background="new 0 0 32 32" id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" 
                                    xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M29,16c0,1.104-0.896,2-2,2H11c-1.104,0-2-0.896-2-2s0.896-2,2-2h16C28.104,14,29,14.896,29,16z" id="XMLID_352_"/>
                                    <path d="M29,6c0,1.104-0.896,2-2,2H11C9.896,8,9,7.104,9,6s0.896-2,2-2h16C28.104,4,29,4.896,29,6z" id="XMLID_354_"/>
                                    <path d="M29,26c0,1.104-0.896,2-2,2H11c-1.104,0-2-0.896-2-2s0.896-2,2-2h16C28.104,24,29,24.896,29,26z" id="XMLID_356_"/>
                                    <path d="M3,6c0,1.103,0.897,2,2,2s2-0.897,2-2S6.103,4,5,4S3,4.897,3,6z" id="XMLID_358_"/><path d="M3,16c0,1.103,0.897,2,2,2s2-0.897,2-2s-0.897-2-2-2S3,14.897,3,16z" id="XMLID_360_"/>
                                    <path d="M3,26c0,1.103,0.897,2,2,2s2-0.897,2-2s-0.897-2-2-2S3,24.897,3,26z" id="XMLID_362_"/>
                                    </svg>
                                </a>
                                <?php if($profId == $getData['user_id']) : ?>
                                    <ul class="dropdown-menu dropdown-menu-2">
                                        <li class="text-center">
                                            <form action="./deletePostAction.php?post_img=<?php echo $getData['post_img'] ?>" method="POST">
                                                <input type="submit" name="deletePost" value="Delete" class="border-0 py-2">
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="text-center">
                                            <a href="./showPost.php?post_img=<?php echo $getData['post_img'] ?>" id="editBtn"><button class="editBtn border-0 py-2">Edit</button></a>
                                        </li>
                                    </ul>
                                <?php else : ?>
                                    <ul class="dropdown-menu dropdown-menu-2">
                                        <li class="text-center">
                                            <form action= method="POST">
                                                <input type="submit" name="deletePost" value="report" class="border-0 py-2">
                                            </form>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                            <div class="col-12">
                                <div class="postDiv" style="background-image: url('./assets/images/<?php echo $getData['post_img']; ?>');">
                                </div>
                            </div>
                            <div class='col-12 pt-2 d-flex gap-3'>
                                <div class="likeDiv d-flex flex-column align-items-center gap-1">
                                    <?php 
                                        $idPost = $getData['post_id'];
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
                                    <input type="hidden" class="likeIdValue" value="<?php echo $postId = $getData['post_id'] ?>">
                                    <a href="./showLikes.php?post_id=<?php echo $postId ?>" class="likeCount text-decoration-none" style="color: var(--secondary-color); cursor: pointer; font-size: 14px;"></a>
                                </div>
                                <div class="" style="padding-top: 2.5px;">
                                    <a href='./showComment.php?post_id=<?php echo $postId = $getData['post_id'] ?>' class='text-decoration-none'>
                                        <svg width="33" viewBox='0 0 28 28' xmlns='http://www.w3.org/2000/svg'><path clip-rule='evenodd' d='M11.0297 3.92593C6.55413 3.92593 2.92593 7.55413 2.92593 12.0298C2.92593 16.5054 6.55413 20.1336 11.0297 20.1336H16.9703C17.1482 20.1336 17.3247 20.1279 17.4995 20.1166C17.8151 20.0963 18.1346 20.195 18.3872 20.4064L21.2349 22.7897C21.3651 22.8987 21.5633 22.8061 21.5633 22.6364V19.3368C21.5633 18.9472 21.7438 18.5898 22.035 18.3564C23.8894 16.8696 25.0741 14.5884 25.0741 12.0298C25.0741 7.55413 21.4459 3.92593 16.9703 3.92593H11.0297ZM1 12.0298C1 6.49047 5.49047 2 11.0297 2H16.9703C22.5095 2 27 6.49047 27 12.0298C27 15.0808 25.6366 17.8141 23.4892 19.6522V24.5077C23.4892 25.5703 22.2488 26.1497 21.4339 25.4677L17.353 22.0523C17.226 22.0571 17.0984 22.0595 16.9703 22.0595H11.0297C5.49047 22.0595 1 17.569 1 12.0298Z' fill='var(--secondary-color)' fill-rule='evenodd'/></svg>
                                    </a>
                                </div>
                            </div>
                        <?php
                            echo "<div class='col-12'>";
                                echo "<p class='descrip pt-2'>" . $getData['description'] . "</p>";
                            echo "</div>";
                    
                        ?>

                            <div class="commentDiv pb-3">
                                <div>
                                    <a href="./showComment.php?post_id=<?php echo $postId = $getData['post_id'] ?>" class="text-decoration-none">
                                        <span style="color: var(--secondary-color); opacity: 0.7;">show all <span class="countComment"></span> comments</span>
                                    </a>
                                </div>
                                <form class="formComment d-flex align-items-center pt-2">
                                    <div class="col-lg-11 col-md-11 col-10">
                                        <input type="text" name="comment" placeholder="Add a comment..." style="width: 100%; background-color: transparent; color: var(--secondary-color);" class="comment border-0 py-2 px-2">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-2">
                                        <button class="commentBtn border-0 py-2 px-2" style="color: blue; background-color: transparent;">Post</button>
                                        <input type="hidden" class="idValue" value="<?php echo $postId = $getData['post_id'] ?>">
                                    </div>
                                </form>
                            </div>
                            <script>

                            </script>
                        <?php
                            echo '<hr>';
                        }
                        ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2"></div>
                </div>
            </div>            
        </div>
    </div>
</body>

<script>

    $(document).ready(function() {
        function loadData() {
            $(".commentDiv").each(function(i, e) {

                var postId = $(this).closest(".commentDiv").find(".idValue").val();

                $.ajax({
                    url: 'countComment.php',
                    type: 'POST',
                    data: {postId: postId},
                    success: function(getData) {
                        $(e).find(".countComment").html(getData);
                    },
                })                                 
            })
        }
        loadData();
        $(document).on("click", ".commentBtn", function(event) {
            event.preventDefault();
            var postId = $(this).closest(".formComment").find(".idValue").val();
            var comment = $(this).closest(".formComment").find(".comment").val();
            var form = $(this).closest(".formComment");

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
    });
// ====================================================================
    $(document).ready(function() {
        function loadLike() {
            $(".likeDiv").each(function(i, e) {

                var postId = $(this).find(".likeIdValue").val();

                $.ajax({
                    url: 'selectLike.php',
                    type: 'POST',
                    data: {postId: postId},
                    success: function(getData) {
                        $(e).find(".likeCount").html(getData);
                    },
                })                                 
            })
        }
        loadLike();

        $(document).on("click", ".svgLike", function(event) {
            event.preventDefault();

            var svgLikeColor = $(this).closest(".likeDiv").find(".svgLikeColor");
            svgLikeColor.toggleClass("svgLikedColor");

            var status = svgLikeColor.hasClass("svgLikedColor"); 

            // console.log(status);

            var postId = $(this).closest(".likeDiv").find(".likeIdValue").val();

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

<script src="./assets/js/Home.js"></script>
<!-- <script src="./assets/reg&log_js.js"></script> -->
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