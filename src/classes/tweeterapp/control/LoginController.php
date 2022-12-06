<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\exceptions\AuthentificationException;
use iutnc\tweeterapp\auth\TweeterAuthentification;
use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view\LoginView;
use iutnc\tweeterapp\model\User;

class LoginController extends AbstractController
{
    public function execute(): void
    {
        if ($this->request->post) {
            if (!User::where('username', '=', $_POST['username'])->count())
                throw new AuthentificationException('Erreur lors de la connexion.');
            
            TweeterAuthentification::login($_POST['username'], $_POST['password']);
            \iutnc\mf\router\Router::executeRoute('home');
        }else{
            $loginView = new LoginView();
            $loginView->makePage();
        }
    }
}
