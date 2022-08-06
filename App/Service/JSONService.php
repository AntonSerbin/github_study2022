<?php

namespace App\Service;

class JSONService
{
    public static function arrToJSON($param)
    {
        return json_encode($param);
    }
}