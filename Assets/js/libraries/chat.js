function initialize() {
    closeModal();
}

function closeModal() {
    if (document.querySelector(".modal-head-close")) {
        let arrData = document.querySelectorAll(".modal-head-close");
        arrData.forEach(element => {
            element.addEventListener("click", () => {
                document.querySelector(".modal").classList.add("hidden");
            })
        })
    }
}
