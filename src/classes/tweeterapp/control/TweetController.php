<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\model\Tweet;

class TweetController extends AbstractController{

    public function execute(): void
    {
        echo Tweet::where('id', '=', $_GET['id'])->get();
    }
}