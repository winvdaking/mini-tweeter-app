<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\model\Tweet;

class HomeController extends AbstractController{

    public function execute(): void
    {
        echo Tweet::select()->get();
    }
}