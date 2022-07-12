<?php

return array(
    'index' => ['login/showUserForm', [false]], //LoginController => actionShowUserForm
    'login' => ['login/showUserForm', [false]], //LoginController => actionShowUserForm
    'checkPassword' => ['login/checkLogin', [false]], //LoginController => actionCheckLogin
    'data' => ['data/showData', ['checkAuth']], //DataController -> actionShowData
    'addStringToDb' => ['data/addStringToDb', ['checkAuth']], //DataController -> actionAddStringToDb
    'enterSettingsDb' => ['login/enterSettingDb', ['checkAuth']], // DataController -> actionEnterSettingDb
    'writeSettingsDb' => ['login/writeSettingDb', ['checkAuth']], // LoginController -> actionWriteSettingDb
    'addNewFile' => ['login/importFile', ['checkAuth']], // LoginController -> actionImportFile
    'copyFileToBackend' => ['login/copyFileToBackend', ['checkAuth']], //LoginController -> actioncopyFileToBackend
    'addStringToFile' => ['file/addStringToFile', ['checkAuth']], //FileController -> actionAddStringToFile
    'logout' => ['login/logout', [false]], //LoginController -> actionLogout
    'signin' => ['login/registerUser', [false]], //LoginController -> actionRegisterUser
    'addNewUser' => ['login/addNewUser', [false]],
    'resetLoginForm' => ['login/restoreFormPassword', [false]],
    'sendEmailRestore' => ['login/sendFormPassword', [false]],
    'modifyPassword' => ['login/rewritePasswordFromEmail', [false]],
    'saveNewPassword' => ['login/saveNewPassword', [false]],
);
