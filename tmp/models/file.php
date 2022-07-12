<?php

namespace models;

class File
{
    public static function showFileTable($indexUser, $fileName = "fileUser.txt")
    {
//        echo "Started model/file -> showFileTable ($fileName, userID = $indexUser) <br>";

        $arrLines = null;
        if (file_exists(ROOT . "/uploadFilesFromUser/$indexUser/$fileName")) {
            $arrLines = file(ROOT . "/uploadFilesFromUser/$indexUser/$fileName");
        }
        return $arrLines;
    }

    public static function writeStringToFile($indexUser, $fileName, $str)
    {
//        echo "Started model/file -> writeFileTable ($fileName, user = $indexUser, строка = $str) <br>";
        if (file_exists(ROOT . "/uploadFilesFromUser/$indexUser/$fileName")) {
            file_put_contents(ROOT . "/uploadFilesFromUser/$indexUser/$fileName", "$str\n", FILE_APPEND);
        }
        return true;
    }
}