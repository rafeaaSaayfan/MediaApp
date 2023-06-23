let colorMode = document.getElementById("colorMode");
let sunMode = document.getElementById("sun");
let moonMode = document.getElementById("moon");
let mode = "";
let Mode = window.localStorage.getItem("Mode");

if(Mode === "light") {
    
    sunMode.classList.add("hide");
    moonMode.classList.remove("hide");

} else {
    
    document.body.classList.toggle("dark-theme");
    sunMode.classList.remove("hide");
    moonMode.classList.add("hide");
};
colorMode.addEventListener("click", () => {

    document.body.classList.toggle("dark-theme");
    if(document.body.classList.contains("dark-theme"))
    {
        sunMode.classList.remove("hide");
        moonMode.classList.add("hide");
        mode = "dark";

    }  else  {
        sunMode.classList.add("hide");
        moonMode.classList.remove("hide");
        mode = "light";
    };
    addModeToLocalStorage(mode);  
});
function addModeToLocalStorage(mode) {
    window.localStorage.setItem("Mode", mode);
};

// =======================================================

let navbarBtn = document.querySelectorAll(".navbarBtn");

navbarBtn.forEach(() => {
    navbarBtn[0].addEventListener("click", () => {
        window.open('http://localhost/MediaApp/Home.php', '_self');
    })
    navbarBtn[1].addEventListener("click", () => {
        window.open('http://localhost/MediaApp/addPost.php', '_self');
    })
    navbarBtn[3].addEventListener("click", () => {
        window.open('http://localhost/MediaApp/profile.php', '_self');
    })
})

// =======================================================

let profileImg = document.getElementById("profileImg");
let spanChangePhoto = document.getElementById("spanChangePhoto");
let changePhotoDiv = document.querySelector(".changePhoto");
let cancel = document.querySelector(".cancel");


profileImg.addEventListener("click", () => {
    changePhotoDiv.classList.toggle("hide");
})
spanChangePhoto.addEventListener("click", () => {
    changePhotoDiv.classList.remove("hide");
})
cancel.addEventListener("click", () => {
    changePhotoDiv.classList.add("hide");
})

// =======================================================

