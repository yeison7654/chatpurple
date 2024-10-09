    <?= header_chat($data) ?>
    <div class="box-login">
        <div class="login-header">
            <a href="" class="btn-in sing  active">Sing In</a>
            <a href="" class="btn-up sing inactive">Sing Up</a>
        </div>
        <div class="login-body">
            <form id="singin">
                <div class="input-form input">
                    <label for="txtUserName">User</label>
                    <input type="text" name="txtUserName" id="txtUserName">
                </div>
                <div class="input-form input">
                    <label for="txtPassword">Password</label>
                    <input type="password" name="txtPassword" id="txtPassword">
                </div>
                <div class="input-form button">
                    <button type="submit">Sing In</button>
                </div>
            </form>
            <form id="singup" class="hidden">
                <div class="input-form input">
                    <label for="txtUser">User</label>
                    <input type="text" name="txtUser" id="txtUser">
                </div>
                <div class="input-form input">
                    <label for="txtMail">E-Mail</label>
                    <input type="email" name="txtMail" id="txtMail">
                </div>
                <div class="input-form input">
                    <label for="txtPassword1">Password</label>
                    <input type="password" name="txtPassword1" id="txtPassword1">
                </div>
                <div class="input-form input">
                    <label for="txtPassword2">Password</label>
                    <input type="password" name="txtPassword2" id="txtPassword2">
                </div>
                <div class="input-form button">
                    <button type="submit">Create</button>
                </div>
            </form>
            <div class="alert hidden">
                <p class="title">title</p>
                <p class="description">description</p>
                <p class="datetime">day year month time</p>
            </div>
        </div>
        <div class="login-footer">
            <a href="">Forgot Password?</a>
        </div>
    </div>
    <?= footer_chat($data) ?>