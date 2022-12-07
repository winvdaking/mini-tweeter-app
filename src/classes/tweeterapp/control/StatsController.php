<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view\StatsView;
use iutnc\tweeterapp\model\Follow;
use iutnc\tweeterapp\model\User;

class StatsController extends AbstractController
{
    public function execute(): void
    {
        $data = User::orderBy('followers', 'DESC')->get();
        $statsView = new StatsView($data);
        $statsView->makePage();
    }
}
