let IdInvertvaloChat = 0;
document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        searchUser();
        selectUserChat();
        listConversaciones()
        sendMessage();
        showModalCreateConversation();
        listUsersSelect();
        createConversation();
    }, 1000);
});
document.addEventListener("click", () => {
    //selectUserChat();
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
//esta funcion me permite cargar los chat de un usuario o conversacion
function selectUserChat() {
    let arrUsers = document.querySelectorAll(".user-chat");
    arrUsers.forEach((element) => {
        element.addEventListener("click", () => {
            document.querySelector(".user-message-title").innerHTML = element.getAttribute("data-name");
            let idUserA = arrInfoUserActive.id;
            let idConver = element.getAttribute("data-id");
            hideChatDashboard();
            if (IdInvertvaloChat != 0) {
                clearInterval(IdInvertvaloChat);
            }
            IdInvertvaloChat = setInterval(() => {
                listChats(idUserA, idConver);
                scrollToBottom();
            }, 500);
        });
    });
}
function listConversaciones() {
    let listUsersChat = document.querySelector("#listUsersChat");
    let idUser = arrInfoUserActive.id;
    let data = new FormData();
    data.append("idUser", idUser);
    let encabezados = new Headers();
    let config = {
        method: "POST",
        headers: encabezados,
        node: "cors",
        cache: "no-cache",
        body: data,
    }
    let url = base_url + "/Chat/listConversation";
    fetch(url, config)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status} - ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.status) {
                let arrInfo = data.data
                let cardUser = "";
                arrInfo.forEach(element => {
                    cardUser += `  <div data-id="${element.id}" data-name="${element.name}" class="user-chat">
                                    <img src="${base_url}/Assets/images/user.png" alt="${element.name}">
                                    <div class="user-body-list">
                                        <div class="user-head-list">
                                            <p class="title-user color-primary">${element.name}</p>
                                            <p class="date-user">17 Sept 09 am</p>
                                        </div>
                                        <p class="user-ultimate-msj email">
                                        </p>
                                    </div>
                               </div>`
                });
                document.querySelector("#listUsersChat").innerHTML = cardUser;
            } else {
                document.querySelector("#listUsersChat").innerHTML = `<p class="title-user color-primary text-center">Sin conversaciones</p>`;
            }
            selectUserChat();
        })
        .catch(error => {
            console.error("Error en el fetch: " + error);
        });

}
function sendMessage() {
    let formMessage = document.querySelector("#formMessage");
    formMessage.addEventListener("submit", (e) => {
        e.preventDefault();
        let data = new FormData(formMessage);
        data.append("idUser", arrInfoUserActive.id);
        let encabezados = new Headers();
        let config = {
            method: "POST",
            headers: encabezados,
            node: "cors",
            cache: "no-cache",
            body: data,
        }
        let url = base_url + "/Chat/sendMessage";
        fetch(url, config)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status} - ${response.statusText}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.status) {
                    let idConver = e.target.idConversation.value;
                    listChats(arrInfoUserActive.id, idConver);
                    formMessage.reset();
                }
            })
            .catch(error => {
                console.error("Error en el fetch: " + error);
            });
    });
}

function listChats(idUserA, idConver) {
    let idConversation = idConver;
    let idUserActivo = idUserA;
    let data = new FormData();
    data.append("idConversation", idConversation);
    data.append("idUserActivo", idUserActivo);
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
                let arrChat = data.data;
                let messageList = document.querySelector("#messageList");
                if (!data.status) {
                    messageList.innerHTML = `<p class="title-user color-primary text-center">${data.text}</p>`;
                    document.querySelector("#idConversation").value = idConversation;
                    return;
                }
                let chats = "";
                arrChat.forEach(element => {
                    if (element.user_id == idUserActivo) {
                        chats += `  <div class="message-me">
                                                <div class="message-head">
                                                    <p>${arrInfoUserActive.username}</p>
                                                </div>
                                                <div class="message-body">
                                                    <p>${element.content}</p>
                                                </div>
                                                <div class="message-foot">
                                                    <span>${element.sent_at}</span>
                                                </div>
                                            </div>`
                    } else {
                        chats += `  <div class="message-user">
                                <div class="message-head">
                                    <p>${element.username}</p>
                                </div>
                                <div class="message-body">
                                    <p>${element.content}</p>
                                </div>
                                <div class="message-foot">
                                    <span>${element.sent_at}</span>
                                </div>
                            </div>`
                    }

                });
                messageList.innerHTML = chats;
                document.querySelector("#idConversation").value = idConversation;
            })
    } catch (error) {
        console.error("Error en el fetch " + error);
    }
}
//funcion que te permite desplazar el scroll al final del chat
function scrollToBottom() {
    let messageList = document.querySelector("#messageList");
    messageList.scrollTop = messageList.scrollHeight;
}
//Funcion que oculta el chat dashboard y muestra las lista de chat seleccionado
function hideChatDashboard() {
    let chatDashboard = document.querySelector(".chat-dashboard");
    chatDashboard.classList.add("hidden");
    let chatList = document.querySelector(".chat-message-list");
    chatList.classList.remove("hidden");
}
//Esta funcion muestra el modal para crear una conversacion
function showModalCreateConversation() {
    let newChat = document.querySelector(".new-chat");
    let openNewChat = document.querySelector("#openNewChat");
    openNewChat.addEventListener("click", () => {
        newChat.classList.remove("hidden");
    });
}
//funcion qu lista el select usuarios con todos los usuario de la red social
function listUsersSelect() {
    let selectUser = document.querySelector("#slctUsuarios");
    let url = base_url + "/Chat/listUsersSelect";
    fetch(url).
        then(response => {
            if (!response.ok) {
                throw new Error("Error en la solicitud: " + response.status +
                    "-" + response.statusText);
            }
            return response.json();
        })
        .then(arrData => {
            let options = `<option value="" selected disabled>Selecciona un usuario</option>`;
            arrData.data.forEach(element => {
                options += `<option value="${element.id}">${element.username}</option>`;
            });
            selectUser.innerHTML = options;
        })
        .catch(error => {
            console.error("Error en el fetch " + error);
        });
}
//funcion que crea una conversacion
function createConversation() {
    let formNewChat = document.querySelector("#formNewChat");
    formNewChat.addEventListener("submit", (e) => {
        e.preventDefault();
        let data = new FormData(formNewChat);
        let headers = new Headers();
        let config = {
            method: "POST",
            headers: headers,
            node: "cors",
            cache: "no-cache",
            body: data
        }
        let url = base_url + "/Chat/createConversation";
        fetch(url, config).
            then(response => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud: " + response.status +
                        "-" + response.statusText);
                }
                return response.json();
            }).
            then(data => {
                listConversaciones();
            }).catch(error => {
                console.error("Error en el fetch " + error);
            });
    }
    );
}