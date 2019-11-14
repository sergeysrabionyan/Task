<?php

namespace MyProject\Controllers;

use MyProject\Controllers\AbstractController;
use MyProject\Models\Numbers\Numbers;
use MyProject\Models\User\User;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\UsersAuthService\UsersAuthService;

class RegisterController extends AbstractController
{


    public function regTemplate()
    {
        $this->view->renderHtml('regPage.php', []);

    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('regPage.php', ['error' => $e->getMessage()]);
                return;
            }
            UsersAuthService::createToken($user);
            header('Location: /');
            exit();
        }

        $this->view->renderHtml('regPage.php');
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('login.php');
    }

    public function logOut()
    {
        UsersAuthService::deleteToken();
        header('Location: /');
    }

}