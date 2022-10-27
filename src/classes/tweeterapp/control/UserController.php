<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\model\User;
use iutnc\tweeterapp\view\UserView;

class UserController extends AbstractController{

    public function execute(): void 
    {   
        $data = User::where('id','=',$_GET['id'])->first()->tweets()->get();
        $userView = new UserView($data);
        $userView->makePage();
    }
}