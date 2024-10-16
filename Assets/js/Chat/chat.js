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
                        let arrInfo = data.info
                        let cardUser = "";
                        arrInfo.forEach(element => {
                            cardUser += `  <div data-id="${element.id}" data-name="${element.username}" data-email="${element.email}" class="user-chat">
                                            <img src="${base_url}/Assets/images/user.png" alt="${element.username}">
                                            <div class="user-body-list">
                                                <div class="user-head-list">
                                                    <p class="title-user color-primary">${element.username}</p>
                                                    <p class="date-user">17 Sept 09 am</p>
                                                </div>
                                                <p class="user-ultimate-msj email">${element.email}
                                                </p>
                                            </div>
                                       </div>`
                        });
                        document.querySelector("#listUsersChat").innerHTML = cardUser;
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
            let idUserAdd = element.getAttribute("data-id");
            let idUserActivo = arrInfoUserActive.id;
            let data = new FormData();
            data.append("idUserActivo", idUserActivo);
            data.append("idUserAdd", idUserAdd);
            let encabezados = new Headers();
            let config = {
                method: "POST",
                headers: encabezados,
                node: "cors",
                cache: "no-cache",
                body: data,
            }
            let url = base_url + "/Chat/conversation"
            try {
                fetch(url, config)
                    .then(response => response.json())
                    .then(data => {

                    })
            } catch (error) {
                console.error("Error en el fetch " + error);
            }
        });
    });
}