<?php

use models\Login;

?>
<!doctype html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings DB Saved</title>
</head>
<body>

<div>
    <form action="data" method="post">
        <div class="container">
            <h2> Thank you, new settings of DataBase are saved </h2>
            <button action="data">OK</button>
        </div>
    </form>
</div>

</body>
</html>