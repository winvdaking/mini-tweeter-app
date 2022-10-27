<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\mf\router\Router;
use iutnc\tweeterapp\model\Tweet;
use iutnc\tweeterapp\view\PostView;

class PostController extends AbstractController
{
    public function execute(): void
    {
        if ($this->request->post) {
            if (isset($_POST['text']) && !empty($_POST['text'])) {
                $tweet = new Tweet();
                $tweet->text = htmlspecialchars($_POST['text']);
                $tweet->author = 11;
                $tweet->score = 0;
                $tweet->save();
                Router::executeRoute('default');
            }else{
                $postView = new PostView();
                $postView->makePage();
            }
        } else if ($this->request->get) {
            $postView = new PostView();
            $postView->makePage();
        }
    }
}
