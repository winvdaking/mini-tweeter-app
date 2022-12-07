<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view\StatsUserView;
use iutnc\tweeterapp\model\Follow;
use iutnc\tweeterapp\model\User;

class StatsUserController extends AbstractController
{
    public function execute(): void
    {
        $data = User::where('id', '=', $_GET['id'])->first();
        $statsUserView = new StatsUserView($data);
        $statsUserView->makePage();
    }
}
