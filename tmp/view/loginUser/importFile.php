<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/tmp/viewview/loginUser/importFile.css">
    <title>ImportFileForm</title>
</head>
<body>
<h2>Import File Form</h2>
<p>You can add two files: </p>
<p>First file with <b>txt</b> extension. Second file with <b>CSV</b> extension</>

<div class="container">
    <form  name="fileForm" enctype="multipart/form-data" method="post" action="/copyFileToBackend">

        <label for="fileTxt"><b>Choose file TXT</b><br></label>
        <input id="inputTxt" type="file" name="fileTxt" accept="text/plain" /><br>
        <p style="color:red; margin: 0;">
            <?php
            $idUser = (int)$_SESSION['user']['id'];
            if (is_file("uploadFilesFromUser/$idUser/fileUser.txt")) {
                echo "File already exist on server, file will be overwritten<br><br>";
            }
            ?>
        </p>

        <label for="fileCsv"><b>Choose file CSV</b><br></label>
        <input id="inputCsv" type="file" name="fileCsv" accept="text/csv"/><br>
        <p style="color:red; margin-top: 0;">
            <?php
            if (is_file("uploadFilesFromUser/$idUser/fileUser.csv")) {
                echo "File already exist on server, file will be overwritten<br><br>";
            }
            ?>
        </p>
        <button type="submit" name="fileForm" >Submit</button>
    </form>

    <!--        <form name="form" enctype="multipart/form-data" method="post" action="copyFileToBackend">-->
    <!--            <input type="file" name="upload_file" title="Выберите файл"/> </br>-->
    <!--            </br>-->
    <!--            <input type="submit" value = "Загрузить файл" name="button" /></br>-->
    <!--        </form>-->


</div>

</body>