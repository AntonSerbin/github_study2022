<?php

if (isset($_POST)) {
    $valid_types = $_POST['typeFile'];
}
if (isset($_FILES['userfile'])) {
    if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
        $filename = basename($_FILES['userfile']['name']);
        echo 'filename - ' . $filename;

        $ext = substr($_FILES['userfile']['name'], 1 + strrpos($_FILES['userfile']['name'], '.'));
        print '<br> Extension: ' . $ext . '<br>';   // strpos --  Возвращает позицию первого вхождения подстроки

        //проверим разрешение файл и выбранный тип из селекта
        $validExtension = 'false';
        echo $ext;
        if ($valid_types == 'pic' && ($ext == 'jpg' || $ext == 'png')) {
            $validExtension = 'true';
        }
        if ($ext == $valid_types) {
            $validExtension = 'true';
        }
        if ($validExtension == 'false') {
            echo 'Error: Invalid file type.';
        } else {
            echo 'File loaded, check you current dir<br>';
            $uploaddir = '/var/www/html/public';
            $uploadfile = $filename;
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            if ($valid_types == 'pic') {
                echo '<img src=' . $uploadfile . ' alt=' . $filename . ' title=' . $filename . ' />';
            }
        }
    } else {
        echo 'Error: empty file.';
    }
} else {
    $contentHTML = "
    <form enctype='multipart/form-data' method='post'>
    Send file: <input name='userfile' type='file'><br>
    <select name='typeFile'>
     <option value='pic'>Picture</option>
      <option value='pdf'>PDF</option>
      <option value='excel'>EXCEL</option>
      <option value='word'>WORD</option>
    </select>
    <input type='submit' value='Send File'><br>
    </form>";
    echo <<<HTML
		{$contentHTML}
HTML;

};
