<?php

namespace App\Controller;

use Framework\frameworkJSON\MakeJSON;
use Framework\Database\ModelDB;

class MakeJSONController
{
    public static function actionShowJSON($params)
    {
        $newParam = explode("=", $params['request']);
        foreach ($newParam as $value) {
            if ($value === "all") {
                $arrListItems = ModelDB::showTable($newParam[0]);
                return MakeJSON::arrToJSON($arrListItems);
            }
        }
        $arrListItems = ModelDB::read($newParam[0], $newParam[1], $newParam[2]);
        return MakeJSON::arrToJSON($arrListItems);
    }
}
