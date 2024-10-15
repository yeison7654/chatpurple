document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        searchUser();
    }, 1000);
});

function searchUser() {
    let formSearchUser = document.querySelector("#formSearchUser");
    formSearchUser.addEventListener("submit", (e) => {
        e.preventDefault();
        let data = new FormData(formSearchUser);
        let encabezados = new Headers();
        let config = {
            method: "POST",
            headers: encabezados,
            node: "cors",
            cache: "no-cache",
            body: data,
        }
        let url = base_url + "/Chat/searchUsers"
        try {
            fetch(url, config)
                .then(response => response.json())
                .then(data => {
                    let alert = document.querySelector(".alert");
                    if (data.status) {
                        document.querySelector(".title").innerHTML = data.title;
                        document.querySelector(".description").innerHTML = data.description;
                        document.querySelector(".datetime").innerHTML = data.datetime;
                        (alert.classList.contains("danger")) ? alert.classList.replace("danger", "success") : alert.classList.add("success");
                        (alert.classList.contains("hidden")) ? alert.classList.remove("hidden") : "";
                        setTimeout(() => {
                            alert.classList.toggle("hidden")
                            this.location.href = data.url
                        }, 2000);
                    } else {
                        document.querySelector(".title").innerHTML = data.title;
                        document.querySelector(".description").innerHTML = data.description;
                        document.querySelector(".datetime").innerHTML = data.datetime;
                        (alert.classList.contains("success")) ? alert.classList.replace("success", "danger") : alert.classList.add("danger");
                        (alert.classList.contains("hidden")) ? alert.classList.remove("hidden") : "";
                        setTimeout(() => {
                            alert.classList.toggle("hidden");
                        }, 2000);
                    }

                })
        } catch (error) {
            console.error("Error en el fetch " + error);
        }
    })
}