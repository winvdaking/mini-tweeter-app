<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\model\Tweet;
use iutnc\tweeterapp\view\HomeView;

class HomeController extends AbstractController{

    public function execute(): void
    {
        $data = Tweet::select()->get();
        $homeView = new HomeView($data);
        $homeView->makePage();
    }
}