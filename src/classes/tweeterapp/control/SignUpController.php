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
            $usrname = filter_var($_POST['username']);
            if (User::where('username', '=', $usrname)->count())
                throw new AuthentificationException('Cet username est déjà utilisé.');
            
            TweeterAuthentification::register($usrname, $_POST['password'], filter_var($_POST['fullname']));
            TweeterAuthentification::login($usrname, $_POST['password']);
            \iutnc\mf\router\Router::executeRoute('home');
        }else{
            $signUpView = new SignUpView();
            $signUpView->makePage();
        }
    }
}
