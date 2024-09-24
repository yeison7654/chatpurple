let box_load = document.querySelector(".box-load");
document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        initialize();
        box_load.classList.toggle("hidden");
    }, 2000);
})