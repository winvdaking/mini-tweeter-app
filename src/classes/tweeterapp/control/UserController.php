<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\model\User;

class UserController extends AbstractController{

    public function execute(): void 
    {
        echo User::where('id','=',$_GET['id'])->first()->tweets()->get();
    }
}