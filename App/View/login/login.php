<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    form {
        border: 3px solid #f1f1f1;
        width: 100%;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    #signinButton {
        width: 57%;
        background: royalblue;
        margin-top: 0;
    }

    #restoreButton {
        width: 40%;
        background: rebeccapurple;
        margin-top: 0;

    }

    button:hover {
        opacity: 0.8;
    }

    .container {
        padding: 16px;
        width: 40%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
</style>
<body>
<h2>Login Form</h2>
<div class="container">
    <form action="/checkPassword" method="post">
        <label for="uName"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uName" required value="Anton">

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required value="1">

        <button type="submit">Login</button>
    </form>

    <button id="signinButton" onclick="location.href='signin'">SignIn new User</button>
    <button id="restoreButton" onclick="location.href='resetLoginForm.php'">Reset Password</button>
</div>

</body>