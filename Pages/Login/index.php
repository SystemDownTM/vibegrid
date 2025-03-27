<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="login">
        <div class="form">
            <label for="chk" aria-hidden="true">Log in</label>
            <input class="input" type="text" id="Username" placeholder="Username" required="">
            <input class="input" type="password" id="Password" placeholder="Password" required="">
            <button onclick="Login()">Log in</button>
        </div>
    </div>
    <div class="register">
        <div class="form">
            <label for="chk" aria-hidden="true">Register</label>
            <input id="UsernameS" class="input" type="text" name="txt" placeholder="Username" required="">
            <input class="input" type="email" placeholder="Email" id="Email" required="">
            <input id="PasswordS" class="input" type="password" name="pswd" placeholder="Password" required="">
            <button onclick="SignUp()">Register</button>
        </div>
    </div>
</div>