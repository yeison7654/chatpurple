document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        searchUser();
        selectUserChat();
    }, 1000);
});
document.addEventListener("click", () => {
    selectUserChat();
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
                        document.querySelector("#listUsersChat").innerHTML = `  <div data-id="${data.info.id}" data-name="${data.info.username}" data-email="${data.info.email}" class="user-chat">
                                                                                    <img src="${base_url}/Assets/images/user.png" alt="${data.info.username}">
                                                                                    <div class="user-body-list">
                                                                                        <div class="user-head-list">
                                                                                            <p class="title-user color-primary">${data.info.username}</p>
                                                                                            <p class="date-user">17 Sept 09 am</p>
                                                                                        </div>
                                                                                        <p class="user-ultimate-msj email">${data.info.email}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>`;
                    } else {
                        document.querySelector("#listUsersChat").innerHTML = `<p class="title-user color-primary text-center">Usuario no encontrado</p>`;
                    }
                    selectUserChat();
                })
        } catch (error) {
            console.error("Error en el fetch " + error);
        }
    })
}

function selectUserChat() {
    let arrUsers = document.querySelectorAll(".user-chat");
    arrUsers.forEach((element) => {
        element.addEventListener("click", () => {
            document.querySelector(".user-message-title").innerHTML = element.getAttribute("data-name");
        });
    });
}