<?= header_chat($data) ?>
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
        <div class="list-body">
            <div class="user-chat">
                <img src="./Assets/img/user.png" alt="">
                <div class="user-body-list">
                    <div class="user-head-list">
                        <p class="title-user color-primary">Usuario en chat</p>
                        <p class="date-user">17 Sept 09 am</p>
                    </div>
                    <p class="user-ultimate-msj">Lorem ipsum dolor sit amet.
                    </p>
                </div>
            </div>
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
    <section class="chat-message-list hidden-movil">
        <nav class="chat-head-message">
            <a href="http://" class="btn-back"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="box-user-message">
                <img src="./Assets/img/user.png" alt="">
                <div class="user-mesage-titles">
                    <p class="user-message-title">Usuario en chat</p>
                    <p class="user-message-online"><i class="fa-solid fa-circle"></i> <span>Online</span></p>
                </div>
            </div>
        </nav>
        <div class="chat-body-message">
            <div class="message-user">
                <div class="message-head">
                    <p>Usuario en linea</p>
                </div>
                <div class="message-body">
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>
                <div class="message-foot">
                    <span>10:53 am</span>
                </div>
            </div>
            <div class="message-me">
                <div class="message-head">
                    <p>Usuario en linea</p>
                </div>
                <div class="message-body">
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>
                <div class="message-foot">
                    <span>10:53 am</span>
                </div>
            </div>
            <div class="message-user">
                <div class="message-head">
                    <p>Usuario en linea</p>
                </div>
                <div class="message-body">
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>
                <div class="message-foot">
                    <span>10:53 am</span>
                </div>
            </div>
            <div class="message-user">
                <div class="message-head">
                    <p>Usuario en linea</p>
                </div>
                <div class="message-body">
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>
                <div class="message-foot">
                    <span>10:53 am</span>
                </div>
            </div>
            <div class="message-user">
                <div class="message-head">
                    <p>Usuario en linea</p>
                </div>
                <div class="message-body">
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>
                <div class="message-foot">
                    <span>10:53 am</span>
                </div>
            </div>
            <div class="message-me">
                <div class="message-head">
                    <p>Usuario en linea</p>
                </div>
                <div class="message-body">
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                </div>
                <div class="message-foot">
                    <span>10:53 am</span>
                </div>
            </div>
        </div>
        <footer class="chat-foot-message">
            <form action="">
                <textarea name="" id="" class="input-message"></textarea>
                <button type="submit" class="btn-send">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </footer>
    </section>
</div>
<?= footer_chat($data) ?>