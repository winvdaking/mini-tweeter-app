<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\exceptions\AuthentificationException;
use iutnc\tweeterapp\auth\TweeterAuthentification;
use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view\SignUpView;
use iutnc\tweeterapp\model\User;

class SignUpController extends AbstractController
{
    public function execute(): void
    {
        if ($this->request->post) {
            if (User::where('username', '=', $_POST['username'])->count())
                throw new AuthentificationException('Cet username est déjà utilisé.');
            
            TweeterAuthentification::register($_POST['username'], $_POST['password'], $_POST['fullname']);
            TweeterAuthentification::login($_POST['username'], $_POST['password']);
            \iutnc\mf\router\Router::executeRoute('home');
        }else{
            $signUpView = new SignUpView();
            $signUpView->makePage();
        }
    }
}