<?php

namespace App\Service;

class MakeJSON
{
    public static function arrToJSON($param)
    {
        echo json_encode($param);
    }
}