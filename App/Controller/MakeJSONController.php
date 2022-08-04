<?php

namespace App\Controller;

use App\Entity\Goods;
use App\Service\MakeJSON;
use Framework\Database\ModelDB;

class MakeJSONController
{
    public function actionShowJSON($params)
    {
        $goods = new Goods();

        $newParam = explode("=", $params['request']);
        foreach ($newParam as $value) {
            if ($value === "all") {
                $arrListItems = $goods->showTable();

                return MakeJSON::arrToJSON($arrListItems);
            }
        }
        $arrListItems = $goods->read($newParam[1], $newParam[2]);
        return MakeJSON::arrToJSON($arrListItems);
    }
}
