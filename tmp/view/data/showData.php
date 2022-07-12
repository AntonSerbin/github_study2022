<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href='/tmp/viewview/data/dataStyle.css'>
    <title>Show Data</title>
</head>
<body>

<div class="parent">

    <aside>
        <button class="settingsButton" onclick="location.href='enterSettingsDb'">Change DataBase Settings</button>
        <button class="settingsButton" onclick="location.href='addNewFile'">Add/Change New File</button>
        <form id="addStringToDb" action="addStringToDb" method="post">
            <input name="srtingToDb" type="text">
            <button type="submit">Add String to DataBase</button>
        </form>
        <form action="addStringToFile" method="post">
            <input name="stringToFile" type="text">
            <button type="submit">Add String to File</button>
            <select name="extType">
                <option value="txt">txt</option>
                <option value="csv">csv</option>
            </select>
        </form>
    </aside>
    <div class="data">
        <h4>Общий список информации:</h4><br>
        <?php
        if ($elementsDB) {
            foreach ($elementsDB as $item => $value) {
                echo '<p> ' . $value . '  (БазаДанных)</p>';
            };
        } else echo " <br>No DB Data<br>";
        echo "<br>";

        foreach ($elementsFiles as $typeFile => $arr) {
            if ($arr) {
                foreach ($arr as $numbStr => $str) {
                    echo "<p> $str (Файл-$typeFile)</p>";
                }
            } else {
                echo " <br>No File Data $typeFile<br>";
            }
            echo "<br>";
        };
        echo "<br>";


        ?>

<!--        <form action="" method="post">-->
<!--            <input name="searchBar" type="text">-->
<!--            <button type="button" onclick='document.getElementById("searchResult").innerHTML =-->
<!--                "book1<br>book2<br>"'>Search!</button>-->
<!--            <p id="searchResult">...search result</p>-->
<!--        </form>-->
    </div>
    <div class="logout">
        <image src="/view/data/images/logout-logo.png" onclick="location.href='/logout'"></image>
    </div>
</div>


</body>
</html>
