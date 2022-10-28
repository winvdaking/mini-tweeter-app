<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view\SignUpView;

class SignUpController extends AbstractController
{
    public function execute(): void
    {
        $loginView = new SignUpView();
        $loginView->makePage();
    }
}
