<?= header_chat($data) ?>
<div class="modal hidden new-chat">
    <div class="modal-content">
        <div class="modal-head">
            <h1 class="modal-head-title">Crear nuevo chat</h1>
            <button class="modal-head-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <form id="formNewChat">
                <div class="form-group">
                    <label for="slctUsuarios">Usuarios</label>
                    <select name="slctUsuarios" id="slctUsuarios">
                    </select>
                </div>
                <div class="form-group">
                    <button>Crear Chat</button>
                </div>
            </form>
        </div>
        <div class="modal-foot"></div>
    </div>
</div>
<div class="box-chat">
    <section class="chat-list">
        <nav class="list-head">
            <div>
                <a href="http://" class="btn-config">
                    <i class="fa-solid fa-gear"></i>
                </a>
            </div>
            <div class="head-titles">
                <p class="title-user"><?= $_SESSION["chat"]["infoUSer"]["username"] ?></p>
                <p class="title-status"><?= $_SESSION["chat"]["infoUSer"]["email"] ?></p>
            </div>
            <div>
                <a href="<?= base_url() ?>/logout" class="btn-exit">
                    <i class="fa-solid fa-door-open"></i>
                </a>
            </div>
        </nav>
        <div class="list-body" id="listUsersChat">

        </div>
        <footer class="list-foot">
            <form name="formSearchUser" id="formSearchUser" class="foot-form-search">
                <input type="search" name="txtSearchUser" id="txtSearchUser" class="input-search"
                    placeholder="Busqueda de chat y conversaciones">
                <button type="submit" class="btn-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <button type="button" class="btn-new-message">
                <i class="fa-regular fa-message"></i>
            </button>
        </footer>
    </section>
    <section class="chat-dashboard hidden-movil">
        <div class="box-menu-dashboard">
            <button id="openNewChat"><i class="fa-solid fa-plus"></i></button>
            <button><i class="fa-solid fa-user"></i></button>
            <button><i class="fa-solid fa-users"></i></button>
            <button><i class="fa-solid fa-door-open"></i></button>
        </div>
    </section>
    <section class="chat-message-list hidden hidden-movil">
        <nav class="chat-head-message">
            <a href="http://" class="btn-back"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="box-user-message">
                <img src="<?= media() ?>/images/user.png" alt="">
                <div class="user-mesage-titles">
                    <p class="user-message-title">Usuario en chat</p>
                    <p class="user-message-online"><i class="fa-solid fa-circle"></i> <span>Online</span></p>
                </div>
            </div>
        </nav>
        <div class="chat-body-message" id="messageList">
        </div>
        <footer class="chat-foot-message">
            <form id="formMessage" class="form-message">
                <input type="hidden" name="idConversation" id="idConversation">
                <textarea name="txtMessage" id="txtMessage" class="input-message"></textarea>
                <button type="submit" class="btn-send">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </footer>
    </section>
</div>
<?= footer_chat($data) ?>