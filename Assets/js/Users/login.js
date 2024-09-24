document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        formSingUp();
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
                    console.log(data);
                });
        } catch (error) {
            console.log("Error en el fetch" + error)
        }
    });
}