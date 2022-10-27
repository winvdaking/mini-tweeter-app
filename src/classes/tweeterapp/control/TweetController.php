<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\model\Tweet;
use iutnc\tweeterapp\view\TweetView;

class TweetController extends AbstractController{

    public function execute(): void
    {
        $data = Tweet::where('id', '=', $_GET['id'])->get();
        $tweetView = new TweetView($data);
        $tweetView->makePage();
    }
}