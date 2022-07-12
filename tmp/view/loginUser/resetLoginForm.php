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

    #submitButton {
        width: 65%;
        margin-top: 0;
    }

    #cancelButton {
        width: 33%;
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
    <form action="/sendEmailRestore" method="post">
        <label for="email"><b>Enter e-mail to reset.<br> New password will be sent to this email:</b></label>
        <input type="text" placeholder="Enter Username" name="email" required value="antons.zn@gmail.com">
        <!--  2 | Kolya | 0b962eceb063c0c09db97ff27ff42460 | kolya@email.com -->
        <button id='submitButton' type="submit">Submit</button>
        <button id='cancelButton' type="button" onclick="location.href='/login';" >Cancel</button>
    </form>

</div>

</body>