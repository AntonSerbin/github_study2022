<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Login;
use Framework\Mail\MailerController;
use Framework\Session\SessionControl;

class LoginController
{
    public function actionShowUserForm()
    {
        $user = new User();
        require_once(ROOT . '/App/View/login/loginPage.php');
        return true;
    }


    public function actionCheckLogin()
    {
        $postData = ($_POST) ? true : false;
        if ($postData) {
            $uName = $_POST['uName'];
            $psw = md5($_POST['psw']);
//            $psw = $_POST['psw'];
            $loginService = new Login();
            $res = $loginService->checkLogin($uName, $psw);

            if ($res) {
                SessionControl::writeDataToSession('id', $res['id']);
                SessionControl::writeDataToSession('email', $res['email']);
                SessionControl::writeDataToSession('login', $res['login']);
                SessionControl::writeDataToSession('firstname', $res['firstname']);
                SessionControl::writeDataToSession('secondname', $res['secondname']);
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
//            'password' => $_POST['psw'],
            'password' => md5($_POST['psw']),
            'firstName' => $_POST['firstName'],
            'secondName' => $_POST['secondName'],
            'phone' => $phone
        ];
        $user = new User();
        $alreadyRegistered = $user->read("email", $dataUser['email']);
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
        require_once(ROOT . '/App/View/login/resetLoginForm.php');
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function actionSendFormPassword()
    {
        $email = $_POST['email'];
        $loginService = new Login();
        $userArr = $loginService->checkEmail($email);

        if ($userArr) {
            $userN = $userArr['login'];
            $content = "Dear $userN,<br> 
                        You requested the reset of password.<br>
                         Please, follow this link to change password:<br>";
            $hash = crypt($email, rand());
            $hash = str_replace('/', '', $hash);
            $content .= $_ENV['WEB_SITE'] . "modifyPassword/" . $hash . "     |       ";
            $content .=  "http://localhost/modifyPassword/" . $hash . "</br>";
            login::modifyUserInDb($userArr['id'], "hash", $hash);
            $user = new User();

            $user->update("hash", $hash, 'id', $userArr['id']);
            $res = (new MailerController())->sendEmail($email, 'new Password PHP_Project: ' . date("h:i:sa"), $content);

            if ($res) {
                echo "Email has been send";
                require_once(ROOT . '/App/View/login/newPasswordSentOK.php');
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

    public function actionRewritePasswordFromEmail($params)
    {
        $hashLink = $params['hash'];
        $loginService = new Login();
        $userData = $loginService->checkHash($hashLink);
        if ($userData) {
            $_SESSION['changePasswordUser'] = $userData;

            require_once(ROOT . "/App/View/login/enterNewPasswordForm.php");
        } else {
            echo "Wrong hash link";
            (new LoginController())->actionShowUserForm();
        }
    }

    public function actionSaveNewPassword()
    {
        $newPassword = md5($_POST['psw']);
//        $newPassword = $_POST['psw'];
        $id = $_SESSION['changePasswordUser']['id'];
        $user = new User();

        $user->update('password', $newPassword, "id", $id);
        unset($_SESSION['changePasswordUser']);
        (new LoginController())->actionShowUserForm();
    }
}
