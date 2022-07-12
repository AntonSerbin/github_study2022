<?php

namespace controllers;

use controllers\DataController;
use frameworkVendor\ConnectionDBUsers;
use frameworkVendor\Router;
use models\Data;
use models\login;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class LoginController
{
    public function actionCheckLogin()
    {
//        echo "LoginController -> запустили actionCheckLogin<br>";

        $postData = ($_POST) ? true : false;
        if ($postData) {
            $uName = $_POST['uName'];
            $psw = md5($_POST['psw']);
            $res = Login::checkLogin($uName, $psw);

            if ($res) {
                $this->writeLoginDataToSession($res);
                require_once(ROOT . '/view/loginUser/correctLogin.php');

            } else {
                require_once(ROOT . '/view/loginUser/wrongLogin.php');
            }
            return true;
        } else {
            require_once(ROOT . '/view/loginUser/wrongLogin.php');
            return false;
        }
    }

    public function writeLoginDataToSession($user)
    {
//        echo "LoginController -> writeLoginToSession(id)<br>";
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['login'] = $user['login'];

        return true;
    }


    public function actionShowUserForm()
    {
//        echo "запустили actionShowUserForm";
        require_once(ROOT . '/view/loginUser/Login.php');
        return true;
    }

    /**
     * @return Write in CREDs of Users DataBase
     */
    public function actionWriteSettingDb()
    {
//        echo "Вызван Логин-Controller->actionWriteSettingDb<br>";

        $DBHost = $_POST['providedDBHost'];
        $DBName = $_POST['providedDBName'];
        $DBUser = $_POST['providedDBUser'];
        $DBPwd = $_POST['providedDBPwd'];
        $DBTable = $_POST['providedTableName'];
        $DBColumn = $_POST['providedColumnName'];

        $userId = $_SESSION['user']['id'];
        $res = login::readDataConnectionById($userId);
        if ($res) {
            login::deleteDataConnectionById($userId);
        };
        $res = login::writeUserSettingDb($userId, $DBHost, $DBName, $DBUser, $DBPwd, $DBTable, $DBColumn);
        if ($res) {
            require_once(ROOT . '/view/loginUser/settingsBDsaved.php');
            return true;
        } else {
            echo "Can't write DB settings";
            return false;
        }
    }

    public function actionEnterSettingDb()
    {
//        echo "<br>Вызван Логин-Controller->enterSettingDb<br>";
        require_once(ROOT . '/view/loginUser/settingsDBConnection.php');
        return true;

    }

    public function actionImportFile()
    {
//        echo "Вызван Логин-Controller->actionImportFile<br>";
        require_once(ROOT . '/view/loginUser/importFile.php');

        return true;

    }

    public function actionCopyFileToBackend()
    {
//        echo "Вызван Логин-Controller->copyFileToBackend<br>";
        $idUser = (int)$_SESSION['user']['id'];

        if (!is_dir("uploadFilesFromUser/$idUser")) {
            mkdir("uploadFilesFromUser/$idUser", 0777, true);
        };

        if ($_FILES['fileTxt']['type'] !== 'text/plain' && $_FILES['fileTxt']['type']) {
            echo 'Wrong extension TXT type';
            die();
        };
        if ($_FILES['fileCsv']['type'] !== 'text/csv' && $_FILES['fileCsv']['type']) {
            echo 'Wrong extension CSV type';
            die();
        };

        if ($_FILES['fileCsv'] || $_FILES['fileTxt']) {
            foreach ($_FILES as $title => $FILE) {
                if ($FILE['name'] != "") {
                    $file = "uploadFilesFromUser/$idUser/" . $_FILES[$title]['name'];
                    move_uploaded_file($_FILES[$title]['tmp_name'], $file);
                    if (isset($_FILES[$title]['name'])) {
                        echo "Загруженный файл: " . $_FILES[$title]['name'] . "</br>";
                        echo "Размер: " . $_FILES[$title]['size'] . "байт";
                    }
                    if ($title == 'fileCsv') {
                        $ext = 'csv';
                    };
                    if ($title == 'fileTxt') {
                        $ext = 'txt';
                    };
                    rename("uploadFilesFromUser/$idUser/" . $_FILES[$title]['name'],
                        "uploadFilesFromUser/$idUser/fileUser.$ext");
                }
            }
        }

        (new DataController)->actionShowData();

        return true;

    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
//        echo "unset Session, end of actionLogout<br>";
        (new LoginController)->actionShowUserForm();
    }

    public function actionRegisterUser()
    {
        require_once(ROOT . '/view/loginUser/registerNewUser.php');
    }


    public function actionAddNewUser()
    {
//        echo "LoginController -> actionAddNewUser<br>";
        $login = $_POST['login'];
        $email = $_POST['email'];
        $psw = md5($_POST['psw']);
        $dataUser = ['login' => $login, 'email' => $email, "psw" => $psw];
        $alreadyRegistered = login::checkEmail($email);
        if ($alreadyRegistered) {
            require_once(ROOT . '/view/loginUser/badRegistrationEmail.php');
            return false;
        } else {
            login::addUserIntoDb($dataUser);
            require_once(ROOT . '/view/loginUser/newUserEntered.php');
            return true;
        }
    }

    public function actionRestoreFormPassword()
    {
//        echo "LoginController -> actionRestoreFormPassword<br>";
        require_once(ROOT . '/view/loginUser/resetLoginForm.php');
    }

    public function actionSendFormPassword()
    {
//        echo "LoginController -> actionSendFormPassword<br>";
        $email = $_POST['email'];
        $userArr = login::checkEmail($email);

        if ($userArr) {
            $userN = $userArr['login'];
            $content = "Dear $userN,<br> You requested the reset of password.<br> Please, follow this link to change password:<br>";
            $hash = crypt($email,rand());
            $hash = str_replace('/', '', $hash);
            $content .= " http://localhost:8181/modifyPassword/" . $hash;
            $res = Login::sendEmail($email, 'new Password PHP_Project: ' . date("h:i:sa"), $content);
            login::modifyUserInDb($userArr['id'], "hash", $hash);

            if ($res) {
                echo "Email has been send";
                require_once(ROOT . '/view/loginUser/newPasswordSentOK.php');
                return true;
            } else {
                echo "Email has NOT been send";
                return false;
            }

        } else {
            echo "<br>There is no such registered User with E-mail $email<br>";
            return false;
        }

    }

    public function actionRewritePasswordFromEmail()
    {
//        echo "LoginController -> actionRewritePasswordFromEmail<br>";
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uriArr = explode("/", $_SERVER['REQUEST_URI']);
        };
        $hashLink = end($uriArr);
        $userData = Login::checkHash($hashLink);
        if ($userData) {
            $_SESSION['changePasswordUser'] = $userData;
            require_once(ROOT . "/view/loginUser/enterNewPasswordForm.php");
        } else {
            echo "Wrong hash link";
            (new LoginController())->actionShowUserForm();
        }
    }

    public function actionSaveNewPassword()
    {
//        echo "LoginController -> actionSaveNewPassword<br>";
        $newPassword = md5($_POST['psw']);
        $id = $_SESSION['changePasswordUser']['id'];
        login::modifyUserInDb($id, 'password', $newPassword);
        unset($_SESSION['changePasswordUser']);
        (new LoginController())->actionShowUserForm();
    }
}
