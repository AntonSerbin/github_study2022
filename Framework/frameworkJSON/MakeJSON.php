<?php

namespace Framework\frameworkJSON;

use Framework\Session;
use Framework\Database;

class MakeJSON
{
    public static function arrToJSON($param)
    {
        echo json_encode($param);
    }
}