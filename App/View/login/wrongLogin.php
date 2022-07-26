<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    form {
        border: 3px solid #f1f1f1;
        width: 40%;
    }

    button {
        background-color: darkslategray;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    .container {
        padding: 16px;
    }
</style>
<body>
<div class="container">

    <h2>Login Form</h2>

    <form action="login" method="post">
        <div class="container">
            <h2> Wrong login/password, <?php if (isset($uName)) {echo $uName;} ?></h2>
            <button type="submit">Try again</button>

        </div>

    </form>
</div>
</body>