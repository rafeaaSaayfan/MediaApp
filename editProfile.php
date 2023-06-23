<?php

include './connect.php';

session_start();

   $Id = $_SESSION['id'];
   $Name = $_SESSION['username'];
   $Img = $_SESSION["image"];
?>
<?php if(!empty($_SESSION)) : ?>
<?php
   $get_bio = mysqli_query($con, "SELECT bio FROM `users_info` WHERE user_id = '$Id';");
   $Get_bio = mysqli_fetch_all($get_bio, MYSQLI_ASSOC);
   $_SESSION["bio"] = $Get_bio[0]['bio'];

   $get_gender = mysqli_query($con, "SELECT gender FROM `users_info` WHERE user_id = '$Id';");
   $Get_gender = mysqli_fetch_all($get_gender, MYSQLI_ASSOC);
   $_SESSION["gender"] = $Get_gender[0]['gender'];

   if(isset($_POST['submit'])) {
      $newName = $_POST['name'];
      $newBio = $_POST['bio'];
      $newGender = $_POST['gender'];


      if(!empty($newName) && strlen($newName) >= 7 && strlen($Bio) < 150) {
            $sqlUpdate = mysqli_query($con, "UPDATE users_info SET user_name = '$newName', bio = '$newBio', gender = '$newGender' WHERE user_id = '$Id';");

            $_SESSION['username'] = $newName;
            $_SESSION['bio'] = $newBio;
            $_SESSION['gender'] = $newGender;


            header('location:profile.php');
            exit();
      }
    }


   if(isset($_POST["uploadFile"])) {

       $newfileName = $_FILES["newFile"]["name"];
       $newfiletmpname = $_FILES["newFile"]["tmp_name"];
       $folder = './assets/images/';
       move_uploaded_file($newfiletmpname, $folder . $newfileName);

       if(!empty($newfileName)) {

         $updateImg = "UPDATE users_info SET profile_img = '$newfileName' WHERE user_name = '$Name'";
         mysqli_query($con, $updateImg);

         $path = $Img;
         if($Img != 'assets/images/user_profile.webp') {
            unlink($path);
          }

       }
    }
    if(isset($_POST['removePhoto'])) {

        $path = $Img;
        if($Img != 'assets/images/user_profile.webp') {
           unlink($path);
         }

       $folder = './assets/images/';
       mysqli_query($con, "UPDATE users_info SET profile_img = 'user_profile.webp' WHERE user_id = '$Id';");

    }

    $imgName = mysqli_query($con, "SELECT profile_img FROM users_info WHERE user_id = '$Id';");
    $ImgName = mysqli_fetch_all($imgName, MYSQLI_ASSOC);
    $folder = './assets/images/';
    $_SESSION["image"] = $folder . $ImgName[0]['profile_img'];

    $profId = $_SESSION['id'];
    $profName = $_SESSION['username'];
    $profImg = $_SESSION["image"];
    $bio =  $_SESSION["bio"];
    $gender =  $_SESSION["gender"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/editProfile.css">
  <title>Document</title>
</head>
<body>
<div class="main-container d-flex">
   <div class="sidebar fixed-top" id="side_nav">
       <div class="header-box px-3 pt-3 pb-4">
           <h3 class="h3 pt-3">MediaApp</h3>
       </div>
        <div class="d-flex flex-column justify-content-space-between container">
            <a class="sideBarBtn p-3 d-flex gap-2 text-decoration-none" href="./Home.php">
               <svg id="Layer_1" style="enable-background:new 0 0 128 128;" version="1.1" viewBox="0 0 128 128" xml:space="preserve" 
               xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g>
               <path d="M120,58.3l-0.2-0.7L64.5,2.5l0,0l0,0L8,58.3V127h45V82h20v45h47V58.3z M112,119H81V74H45v45H16V62.6l48.5-48.8L112,61.7V119z"/></g>
               </svg>
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
               <svg enable-background="new 0 0 32 32" id="Stock_cut" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" 
               xmlns:xlink="http://www.w3.org/1999/xlink" class="messaSvg"><desc/><g><polygon fill="none" points="2,3 2,23 6,23    6,29 12,23 30,23 30,3  " 
               fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><circle cx="8" cy="13" r="2" 
               fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><circle cx="16" cy="13" r="2" 
               fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><circle cx="24" cy="13" r="2" 
               fill="none" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/></g></svg>
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
    <div class="content pb-4 pt-1">
        <nav class="navbar fixed-bottom">
            <div class="container d-flex align-items-center">
                <svg id="Layer_1" style="enable-background:new 0 0 128 128;" version="1.1" viewBox="0 0 128 128" xml:space="preserve" class="navbarBtn"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g>
                    <path d="M120,58.3l-0.2-0.7L64.5,2.5l0,0l0,0L8,58.3V127h45V82h20v45h47V58.3z M112,119H81V74H45v45H16V62.6l48.5-48.8L112,61.7V119z"/></g>
                </svg>
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="navbarBtn">
                    <path d="M19,6 L19,4 L21,4 L21,6 L23,6 L23,8 L21,8 L21,10 L19,10 L19,8 L17,8 L17,6 L19,6 Z M6.93701956,5.8453758 C7.00786802,5.74688188 7.08655595,5.62630624 7.18689462,5.46372136 C7.24312129,5.37261385 7.44826978,5.03326386 7.48180256,4.97841198 C8.31078556,3.62238733 8.91339479,3 10,3 L15,3 L15,5 L10,5 C9.91327186,5 9.64050202,5.28172235 9.18819752,6.02158802 C9.15916322,6.06908141 8.95096113,6.41348258 8.88887147,6.51409025 C8.76591846,6.71331853 8.66374696,6.86987867 8.56061313,7.0132559 C8.1123689,7.63640757 7.66434207,8 7.0000003,8 L4,8 C3.44771525,8 3,8.44771525 3,9 L3,18 C3,18.5522847 3.44771525,19 4,19 L20,19 C20.5522847,19 21,18.5522847 21,18 L21,12 L23,12 L23,18 C23,19.6568542 21.6568542,21 20,21 L4,21 C2.34314575,21 1,19.6568542 1,18 L1,9 C1,7.34314575 2.34314575,6 4,6 L6.81619668,6 C6.84948949,5.96193949 6.89029794,5.91032846 6.93701956,5.8453758 Z M12,18 C9.23857625,18 7,15.7614237 7,13 C7,10.2385763 9.23857625,8 12,8 C14.7614237,8 17,10.2385763 17,13 C17,15.7614237 14.7614237,18 12,18 Z M12,16 C13.6568542,16 15,14.6568542 15,13 C15,11.3431458 13.6568542,10 12,10 C10.3431458,10 9,11.3431458 9,13 C9,14.6568542 10.3431458,16 12,16 Z" fill-rule="evenodd"/>
                </svg>
                <svg enable-background="new 0 0 32 32" id="Stock_cut" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" 
                    xmlns:xlink="http://www.w3.org/1999/xlink" class="messaSvg navbarBtn"><desc/><g><polygon fill="none" points="2,3 2,23 6,23    6,29 12,23 30,23 30,3  " 
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
       <!-- ============================================== -->
        <div class="main-content container pt-2 pb-5">
            <h4 class="settings pt-3">Settings</h4>
          <div class="container">
             <div class="row">
                <div class="col-lg-3 col-md-3"></div>
                <div class="contentEdit pt-2 mt-3 pb-5 col-lg-8 col-md-8 ms-lg-5">
                    <div class="menuEdit">
                        <ul class="d-flex container">
                            <li class="menuEditLi p-2" style="cursor: pointer;">
                                <a href="./editProfile.php" class="text-decoration-none fw-bold pt-2 pb-2 ps-3 pe-3">Edit profile</a>
                            </li>
                            <li class="menuEditLi p-2" style="cursor: pointer;">
                                <a href="./editProfessionalAccount.php" class="text-decoration-none pt-2 pb-2 ps-3 pe-3">Professional account</a>
                            </li>
                            <li class="menuEditLi p-2" style="cursor: pointer;">
                                <a href="./editSecurity.php" class="text-decoration-none pt-2 pb-2 ps-3 pe-3">Security</a>
                            </li>
                        </ul>                     
                    </div>
                    <div class="container d-flex flex-column gap-4">
                        <h4 style="font-size: 19px;" class="pt-3">Edit Profile</h4>
                        <div class="name&photo container">
                            <div class="row">
                                <div class="col-lg-4 col-md-3"></div>
                                <div class="col-lg-2 col-md-2 col-4">
                                    <?php
                                       echo "<img src='$profImg' id='profileImg' class='rounded-pill'>"
                                    ?>
                                </div>
                                <div class="d-flex flex-column pt-lg-3 col-lg-4 col-md-5 col-8">
                                    <span class='profName'><?php echo $profName ?></span>
                                    <span style="color: blue; cursor: pointer; font-size: 13px;" id="spanChangePhoto">Change profile photo</span>
                                </div>
                                <div class="col-lg-2 col-md-2"></div>
                            </div>
                        </div>
                        <form action="" method="POST" name="form" class="d-flex flex-column gap-5 pt-3">
                            <div class="nameInput">
                                <?php
                                    echo "<div class='container'>";
                                        echo "<div class='row align-items-center'>";
                                            echo "<div class='col-lg-2 col-md-2'></div>";
                                            echo "<div class='col-lg-2 col-md-2 ps-lg-4 text-lg-center text-md-center'>";
                                               echo "<label for='name' style='color: blue;'>Name:</label>";
                                            echo "</div>";
                                            echo "<div class='col-lg-7 col-md-7'>";
                                               echo "<input type='name' value='$profName' name='name' class='form-control' placeholder='Name'>";
                                              if(isset($_POST['submit'])) {
                                                if(empty($_POST['name'])) {
                                                 echo "<span style='color: red;'>Enter your new name</span>";
                                                } else if(strlen($_POST['name']) < 7) {
                                                 echo "<span style='color: red;'>Your name must be at least 7 characters</span>";
                                                }
                                              }
                                            echo "</div>";
                                            echo "<div class='col-lg-1 col-md-1'></div>";
                                        echo "</div>";
                                    echo "</div>";
                                ?>
                            </div>
                            <div class="BioInput">
                                <?php
                                    echo "<div class='container'>";
                                        echo "<div class='row align-items-center'>";
                                            echo "<div class='col-lg-2 col-md-2'></div>";
                                            echo "<div class='col-lg-2 col-md-2 ps-lg-4 text-lg-center text-md-center'>";
                                              echo "<label for='bio' style='color: blue;'>Bio:</label>";
                                            echo "</div>";
                                            echo "<div class='col-lg-7 col-md-7'>";
                                               echo "<textarea type='text' id='message' name='bio' rows='2' class='form-control md-textarea justify-content-center' style='color: black;' placeholder='Enter a bio'>$bio</textarea>";
                                               if(isset($_POST['submit'])) {
                                                 if(strlen($_POST['bio']) > 150) {
                                                     echo "<span style='color: red;'>Your Bio must be under 150 characters</span>";
                                                 }
                                              }
                                            echo "</div>";
                                            echo "<div class='col-lg-1 col-md-1'></div>";
                                        echo "</div>";
                                    echo "</div>";
                                ?>
                            </div>
                            <div class="genderInput">
                                <?php
                                    echo "<div class='container'>";
                                        echo "<div class='row align-items-center'>";
                                            echo "<div class='col-lg-2 col-md-2'></div>";
                                            echo "<div class='col-lg-2 col-md-2 ps-lg-4 text-lg-center text-md-center'>";
                                              echo "<label for='gender' style='color: blue;'>Gender:</label>";
                                            echo "</div>";
                                            echo "<div class='col-lg-7 col-md-7'>";
                                               echo "<select name='gender' class='form-control'>";
                                                 if($gender === "Male") {
                                                  echo "<option value='Male'>Male</option>";
                                                  echo "<option value='Female'>Female</option>";
                                                 } else {
                                                    echo "<option value='Female'>Female</option>";
                                                    echo "<option value='Male'>Male</option>";
                                                 }
                                               echo "</select>";
                                            echo "</div>";
                                            echo "<div class='col-lg-1 col-md-1'></div>";
                                        echo "</div>";
                                    echo "</div>";
                                ?>
                            </div>
                            <div class="submitInput container"> 
                              <div class="row">
                                <div class="col-lg-4 col-md-4"></div>
                                <div class="col-lg-7 col-md-7">
                                   <input type="submit" name="submit" value="submit" class="submit pt-1 pb-2 ps-4 pe-4 border-0 text-white"> 
                                </div>
                                <div class="col-lg-1 col-md-1"></div>
                              </div>
                            </div>     
                        </form>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1"></div>
             </div>
          </div>
       </div>
   </div>
</div>
<div class="changePhoto container hide">
    <div class="row">
        <div class="col-lg-4 col-md-3 col-1"></div>
        <div class="changeDiv col-lg-6 col-md-6 col-10 pt-3 pb-2">
            <h4 class="text-center">Change Profile Photo</h4>
            <hr>
            <form action="" method="POST" enctype="multipart/form-data" class="text-center">
                <button>
                   <input type="file" name="newFile">
                   Upload Photo
                </button>
                <input type="submit" name="uploadFile" value="save" class="ms-3 ps-3 pe-3 pt-1 pb-1 border-0">
            </form>
            <?php if($profImg != './assets/images/user_profile.webp') : ?>
                <hr>
                <form action="" method="POST" enctype="multipart/form-data" class="text-center">
                    <input type="submit" name="removePhoto" value="Remove Current Photo" class="border-0" 
                    style="background-color: transparent; color: red; font-size: 16px; width: 100%;">
                </form>
            <?php endif; ?>
            <hr>
            <p class="text-center p2 cancel">Cancel</p>  
        </div> 
        <div class="col-lg-2 col-md-3 col-1"></div>
    </div>             
</div>
</body>

<script src="./assets/js/editProfile.js"></script>
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