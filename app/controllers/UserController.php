<?php

class UserController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';

        $errors = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        }

        if (!User::checkName($name)) {
            $errors[] = 'Имя не должно быть короче 2-х символов';
        }

        if (!User::checkEmail($email)) {
            $errors[] = 'Неправильный email';
        }

        if (!User::checkPassword($password)) {
            $errors[] = 'Пароль не должен быть короче 6-ти символов';
        }

        if (User::checkEmailExists($email)) {
            $errors[] = 'Такой email уже используется';
        }

        if ($errors == false) {
            $result = User::register($name, $email, $password);
        }

        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (!$_POST == []) {
            $errors = false;

            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($errors == false) {
                $userId = User::checkUserData($email, $password);
                if (!$userId) {
                    $errors[] = 'Такого пользователя не существует';
                } else {
                    User::auth($userId);
                    header("Location: /cabinet/");
                    return true;
                }
            }
        }

        require_once ROOT . '/views/user/login.php';
        return true;
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
        header("Location: /");
        return true;
    }
}