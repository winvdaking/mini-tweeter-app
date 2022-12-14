<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\model\Tweet;
use iutnc\tweeterapp\model\User;
use iutnc\tweeterapp\view\HomeView;

class HomeController extends AbstractController{

    public function execute(): void
    {
        $data = Tweet::select()->orderBy('created_at', 'DESC')->get();
        $homeView = new HomeView($data);
        $homeView->makePage();
    }
}