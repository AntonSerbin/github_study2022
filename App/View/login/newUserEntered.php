<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    form {
        border: 3px solid #f1f1f1;
        width: 40%;
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

    button:hover {
        opacity: 0.8;
    }

    .container {
        padding: 16px;
    }
</style>
<body>
<div class="container">

    <h2>New User entered</h2>

    <form action="login" method="post">
        <div class="container">
            <h2> Thank you, <?php echo $dataUser['login']; ?> are Signed in </h2>
            <button action="data">OK</button>

        </div>

    </form>
</div>
</body>