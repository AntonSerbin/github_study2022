<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="view\loginUser\loginStyle.css">
    <title>Settings DB Connection</title>
</head>
<body>

<div class="parentSettings">
    <form name="settingsDb" action="/writeSettingsDb" method="post">
        <p>DB Host:</p>
        <input type="text" name="providedDBHost" value="a_level_mysql:3306"><br>
        <p>DB Name:</p>
        <input type="text" name="providedDBName" value="a_level_mysql"><br>
        <p>DB User:</p>
        <input type="text" name="providedDBUser" value="root"><br>
        <p>DB Password:</p>
        <input type="password" name="providedDBPwd" value="antons"><br>
        <p>Table Name in DB:</p>
        <input type="text" name="providedTableName" value="dataFromUser"><br>
        <p>Column name in table:</p>
        <input type="text" name="providedColumnName" value="string"><br>
        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>