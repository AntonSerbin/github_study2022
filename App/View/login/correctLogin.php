<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    form {
        padding-top: 50px;
        border: 3px solid #f1f1f1;
        width: 50%;
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

    <h2>Login Form</h2>

    <?php require_once(ROOT . '/App/View/header/header.php'); ?>

    <form action="login" method="post">
            <h4> Thank you, <?php echo $uName; ?> are logged in </h4>
            <button action="data" class="btn btn-primary btn-block">OK</button>


    </form>


</div>
</body>