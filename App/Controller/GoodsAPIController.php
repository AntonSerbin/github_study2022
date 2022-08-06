<?php

namespace App\Controller;

use App\Entity\Goods;
use App\Service\JSONService;

class GoodsAPIController
{
    public function actionGetGoods($params)
    {
        $goods = new Goods();

        if ($params['category'] === "all") {
            $arrListItems = $goods->select();
            echo JSONService::arrToJSON($arrListItems);
            return;
        }
        $arrListItems = $goods->where("category",$params['category'])->select();
echo JSONService::arrToJSON($arrListItems);
    }
}
