<?php

return array(
    'index' => ['login/showUserForm'], //LoginController => actionShowUserForm
    'login' => ['login/showUserForm'], //LoginController => actionShowUserForm
    'checkPassword' => ['login/checkLogin'], //LoginController => actionCheckLogin
    'signin' => ['login/registerUser'], //LoginController -> actionRegisterUser
    'addNewUser' => ['login/addNewUser'],
    'resetLoginForm' => ['login/restoreFormPassword'],
    'data' => ['data/showData', ['checkAuth']], //DataController -> actionShowData
    'logout' => ['login/logout'], //LoginController -> actionLogout

    'sendEmailRestore' => ['login/sendFormPassword'],
    'modifyPassword/:hash' => ['login/rewritePasswordFromEmail'],
    'saveNewPassword' => ['login/saveNewPassword'],

    'api/goods/:category' => ['goodsAPI/getGoods'],

    'goods/:category' => ['data/showPageGoods'],
    'requestDataPage' => ['data/requestDataGoods'],
    "items/:id" => ['data/showPageItem'],

    'cart' => ['data/cart'],

    'placedOrder' => ['data/placedOrder'],
    'showOrder/:id' => ['data/showOrder']
);
