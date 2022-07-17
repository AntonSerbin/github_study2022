<?php

namespace App\Controller;

use Framework\Database\ModelDB;
use App\Entity\Login;
use Framework\Mail\MailerController;
use Framework\Session\SessionControl;

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;


class LoginController
{
    public function actionShowUserForm()
    {
        echo "запустили actionShowUserForm - start";
        print_r(SessionControl::getSession());
        ModelDB::showTable('users');

        require_once(ROOT . '/App/View/login/loginPage.php');

        return true;
    }


    public function actionCheckLogin()
    {
        echo "LoginController -> запустили actionCheckLogin<br>";
        print_r($_POST);
        echo "<br>";

        $postData = ($_POST) ? true : false;
        if ($postData) {
            $uName = $_POST['uName'];
//            $psw = md5($_POST['psw']);
            $psw = $_POST['psw'];
            echo $psw . "<br>";
            $res = Login::checkLogin($uName, $psw);
            echo "<br> res= ";
            print_r($res);

            if ($res) {
                SessionControl::writeDataToSession('id_user', $res['id_user']);
                SessionControl::writeDataToSession('email', $res['email']);
                SessionControl::writeDataToSession('login', $res['login']);
                SessionControl::writeDataToSession('firstname', $res['firstName']);
                SessionControl::writeDataToSession('secondname', $res['secondName']);
                SessionControl::writeDataToSession('phone', $res['phone']);

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

    public function actionLogout()
    {
        echo "Вызван Логин-Controller->actionLogout1<br>";
        SessionControl::unsetSession("user");
        (new LoginController)->actionShowUserForm();
    }

    public function actionRegisterUser()
    {
        require_once(ROOT . '/App/View/login/registerNewUser.php');
    }


    public function actionAddNewUser()
    {
        echo "LoginController -> actionAddNewUser<br>";
        $phone = preg_replace('~\D+~', '', $_POST['phone']);
        $dataUser = [
            'login' => $_POST['login'],
            'email' => $_POST['email'],
            'password' => $_POST['psw'],
//            'password' => md5($_POST['psw']),
            'firstName' => $_POST['firstName'],
            'secondName' => $_POST['secondName'],
            'phone' => $phone
        ];
//        $alreadyRegistered = login::checkEmail($email);
        $alreadyRegistered = ModelDB::read('users', "email", $dataUser['email']);
        print_r($alreadyRegistered);
        if ($alreadyRegistered) {
            require_once(ROOT . '/App/View/login/badRegistrationEmail.php');
            return false;
        } else {
            Login::addUserIntoDb($dataUser);
            require_once(ROOT . '/App/View/login/newUserEntered.php');
            return true;
        }
    }

    public function actionRestoreFormPassword()
    {
        echo "LoginController -> actionRestoreFormPassword<br>";
        require_once(ROOT . '/App/View/login/resetLoginForm.php');
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function actionSendFormPassword()
    {
        echo "LoginController -> actionSendFormPassword<br>";
        $email = $_POST['email'];
        $userArr = Login::checkEmail($email);
        echo "<pre>";
        print_r($userArr);
        echo $userArr['login'];
        echo "<br>";
        if ($userArr) {
            $userN = $userArr['login'];
            $content = "Dear $userN,<br> 
                        You requested the reset of password.<br>
                         Please, follow this link to change password:<br>";
            $hash = crypt($email, rand());
            $hash = str_replace('/', '', $hash);
            $content .= " http://localhost:80/modifyPassword/" . $hash;
            $res = (new MailerController())->sendEmail();
//            $res = MailerController::sendEmail($email, 'new Password PHP_Project: ' . date("h:i:sa"), $content);
//            $res = login::sendEmail($email, 'new Password PHP_Project: ' . date("h:i:sa"), $content);
//            login::modifyUserInDb($userArr['id'], "hash", $hash);
            $res=false;
            if ($res) {
                echo "Email has been send";
                require_once(ROOT . 'App/View/login/newPasswordSentOK.php');
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
