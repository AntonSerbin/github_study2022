<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    form {
        border: 3px solid #f1f1f1;
        width: 70%;
    }

    button {

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
    <?php require_once (ROOT.'/App/View/header/header.php'); ?>
    <h2>New User entered</h2>

    <form action="login" method="post">
        <div class="container">
            <h2> Thank you, <?php echo $dataUser['login']; ?> are Signed in </h2>
            <button class="btn btn-primary" action="data">OK</button>

        </div>

    </form>
</div>
</body>