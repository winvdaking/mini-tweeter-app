<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\mf\router\Router;

class LogoutController extends AbstractController
{
    public function execute(): void
    {
        session_destroy();
        unset($_SESSION['user_profile']);
        Router::executeRoute('default');
    }
}
