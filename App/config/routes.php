<?php

return array(
    'index' => ['login/showUserForm'], //LoginController => actionShowUserForm
    'login' => ['login/showUserForm'], //LoginController => actionShowUserForm
    'checkPassword' => ['login/checkLogin'], //LoginController => actionCheckLogin
    'data' => ['data/showData', ['checkAuth']], //DataController -> actionShowData
    'addStringToDb' => ['data/addStringToDb', ['checkAuth']], //DataController -> actionAddStringToDb
    'enterSettingsDb' => ['login/enterSettingDb', ['checkAuth']], // DataController -> actionEnterSettingDb
    'writeSettingsDb' => ['login/writeSettingDb', ['checkAuth']], // LoginController -> actionWriteSettingDb
    'addNewFile' => ['login/importFile', ['checkAuth']], // LoginController -> actionImportFile
    'copyFileToBackend' => ['login/copyFileToBackend', ['checkAuth']], //LoginController -> actioncopyFileToBackend
    'addStringToFile' => ['file/addStringToFile', ['checkAuth']], //FileController -> actionAddStringToFile
    'logout' => ['login/logout'], //LoginController -> actionLogout
    'signin' => ['login/registerUser'], //LoginController -> actionRegisterUser
    'addNewUser' => ['login/addNewUser'],
    'resetLoginForm' => ['login/restoreFormPassword'],
    'sendEmailRestore' => ['login/sendFormPassword'],
    'modifyPassword' => ['login/rewritePasswordFromEmail'],
    'saveNewPassword' => ['login/saveNewPassword'],
);
