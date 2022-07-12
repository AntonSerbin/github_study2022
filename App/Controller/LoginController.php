<?php

namespace App\Controller;

use Framework\Database\ModelDB;
use App\Entity\Login;

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;


class LoginController
{
    public function actionShowUserForm()
    {
        echo "запустили actionShowUserForm - start";
        require_once(ROOT . '/App/View/login/loginPage.php');

        ModelDB::showTable('users');

        return true;
    }


    public function actionCheckLogin()
    {
        echo "LoginController -> запустили actionCheckLogin<br>";
        echo "Рост";
        print_r($_POST);
        echo "<br><br>";

        $postData = ($_POST) ? true : false;
        if ($postData) {
            $uName = $_POST['uName'];
//            $psw = md5($_POST['psw']);
            $psw = $_POST['psw'];
            echo $psw."<br>";
            $res = Login::checkLogin($uName, $psw);
            echo "<br> res= ";
            print_r($res);

            if ($res) {
                $this->writeLoginDataToSession($res);
                require_once(ROOT . '/App/View/login/correctLogin.php');

            } else {
                require_once(ROOT . '/App/View/login/wrongLogin.php');
            }
            return true;
        } else {
            require_once(ROOT . '/App/View/login/wrongLogin.php');
            return false;
        }
    }

    public function writeLoginDataToSession($user)
    {
        echo "LoginController -> writeLoginToSession(id)<br>";
//        $_SESSION['user']['id'] = $user['id'];
//        $_SESSION['user']['email'] = $user['email'];
//        $_SESSION['user']['login'] = $user['login'];

        return true;
    }

    public function actionLogout()
    {
        echo "Вызван Логин-Controller->actionLogout<br>";

//        unset($_SESSION['user']);
//        (new LoginController)->actionShowUserForm();
    }

    public function actionAddNewUser()
    {
        echo "LoginController -> actionAddNewUser<br>";
//        $login = $_POST['login'];
//        $email = $_POST['email'];
//        $psw = md5($_POST['psw']);
//        $dataUser = ['login' => $login, 'email' => $email, "psw" => $psw];
//        $alreadyRegistered = login::checkEmail($email);
//        if ($alreadyRegistered) {
//            require_once(ROOT . '/view/loginUser/badRegistrationEmail.php');
//            return false;
//        } else {
//            login::addUserIntoDb($dataUser);
//            require_once(ROOT . '/view/loginUser/newUserEntered.php');
//            return true;
//        }
    }

    public function actionRestoreFormPassword()
    {
        echo "LoginController -> actionRestoreFormPassword<br>";
//        require_once(ROOT . '/view/loginUser/resetLoginForm.php');
    }

    public function actionSendFormPassword()
    {
        echo "LoginController -> actionSendFormPassword<br>";
//        $email = $_POST['email'];
//        $userArr = login::checkEmail($email);
//
//        if ($userArr) {
//            $userN = $userArr['login'];
//            $content = "Dear $userN,<br> You requested the reset of password.<br> Please, follow this link to change password:<br>";
//            $hash = crypt($email,rand());
//            $hash = str_replace('/', '', $hash);
//            $content .= " http://localhost:8181/modifyPassword/" . $hash;
//            $res = Login::sendEmail($email, 'new Password PHP_Project: ' . date("h:i:sa"), $content);
//            login::modifyUserInDb($userArr['id'], "hash", $hash);
//
//            if ($res) {
//                echo "Email has been send";
//                require_once(ROOT . '/view/loginUser/newPasswordSentOK.php');
//                return true;
//            } else {
//                echo "Email has NOT been send";
//                return false;
//            }
//
//        } else {
//            echo "<br>There is no such registered User with E-mail $email<br>";
//            return false;
//        }

    }

    public function actionRewritePasswordFromEmail()
    {
        echo "LoginController -> actionRewritePasswordFromEmail<br>";
//        if (!empty($_SERVER['REQUEST_URI'])) {
//            $uriArr = explode("/", $_SERVER['REQUEST_URI']);
//        };
//        $hashLink = end($uriArr);
//        $userData = Login::checkHash($hashLink);
//        if ($userData) {
//            $_SESSION['changePasswordUser'] = $userData;
//            require_once(ROOT . "/view/loginUser/enterNewPasswordForm.php");
//        } else {
//            echo "Wrong hash link";
//            (new LoginController())->actionShowUserForm();
//        }
    }

    public function actionSaveNewPassword()
    {
        echo "LoginController -> actionSaveNewPassword<br>";
//        $newPassword = md5($_POST['psw']);
//        $id = $_SESSION['changePasswordUser']['id'];
//        login::modifyUserInDb($id, 'password', $newPassword);
//        unset($_SESSION['changePasswordUser']);
//        (new LoginController())->actionShowUserForm();
    }
}
