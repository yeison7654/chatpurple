function initialize() {
    SingInUp();
}

function SingInUp() {
    let singin = document.querySelector("#singin");
    let singup = document.querySelector("#singup");
    let btnIn = document.querySelector(".btn-in");
    let btnUp = document.querySelector(".btn-up");
    btnIn.addEventListener("click", (e) => {
        e.preventDefault();
        if (singin.classList.contains("hidden") &&
            btnIn.classList.contains("inactive") &&
            !singup.classList.contains("hidden") &&
            btnUp.classList.contains("active")) {
            singin.classList.toggle("hidden");
            btnIn.classList.replace("inactive", "active");
            singup.classList.add("hidden");
            btnUp.classList.replace("active", "inactive");
            singin.reset();
        }
    })
    btnUp.addEventListener("click", (e) => {
        e.preventDefault();
        if (singup.classList.contains("hidden") &&
            btnUp.classList.contains("inactive") &&
            !singin.classList.contains("hidden") &&
            btnIn.classList.contains("active")) {
            singup.classList.toggle("hidden");
            btnUp.classList.replace("inactive", "active");
            singin.classList.add("hidden");
            btnIn.classList.replace("active", "inactive");
            singup.reset();
        }
    })
}