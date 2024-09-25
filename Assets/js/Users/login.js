document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        formSingUp();
        formSingIn();
    }, 1500);
});

function formSingUp() {
    let singup = document.getElementById("singup");
    singup.addEventListener("submit", (e) => {
        e.preventDefault();
        let data = new FormData(singup);
        let encabezados = new Headers();
        let config = {
            method: "POST",
            headers: encabezados,
            node: "cors",
            cache: "no-cache",
            body: data
        }
        let url = base_url + "/Users/saveUsers";
        try {
            fetch(url, config).
                then(response => response.json()).
                then((data) => {
                    let alert = document.querySelector(".alert");
                    if (data.status) {
                        document.querySelector(".title").innerHTML = data.title;
                        document.querySelector(".description").innerHTML = data.description;
                        document.querySelector(".datetime").innerHTML = data.datetime;
                        (alert.classList.contains("danger")) ? alert.classList.replace("danger", "success") : alert.classList.add("success");
                        (alert.classList.contains("hidden")) ? alert.classList.remove("hidden") : "";
                    } else {
                        document.querySelector(".title").innerHTML = data.title;
                        document.querySelector(".description").innerHTML = data.description;
                        document.querySelector(".datetime").innerHTML = data.datetime;
                        (alert.classList.contains("success")) ? alert.classList.replace("success", "danger") : alert.classList.add("danger");
                        (alert.classList.contains("hidden")) ? alert.classList.remove("hidden") : "";
                    }
                    setTimeout(() => {
                        alert.classList.toggle("hidden");
                    }, 2000);
                });
        } catch (error) {
            console.log("Error en el fetch" + error)
        }
    });
}
function formSingIn() {
    let singin = document.getElementById("singin");
    singin.addEventListener("submit", (e) => {
        e.preventDefault();
        let data = new FormData(singin);
        let encabezados = new Headers();
        let config = {
            method: "POST",
            headers: encabezados,
            node: "cors",
            cache: "no-cache",
            body: data,
        }
        let url = base_url + "/Users/singIn"
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