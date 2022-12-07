<?php

namespace iutnc\tweeterapp\control;

use iutnc\mf\control\AbstractController;
use iutnc\tweeterapp\view\FollowingView;
use iutnc\mf\auth\AbstractAuthentification;
use iutnc\tweeterapp\model\Follow;
use iutnc\tweeterapp\model\User;

class FollowingController extends AbstractController{

    public function execute(): void
    {
        if ($this->request->post) {
            $flw = Follow::where('followee', '=', $_POST['followee'])->where('follower', '=', $_SESSION['user_profile']['id'])->first();
            if (isset($_POST['unfollow'])){
                $flw->delete();

                $usr = User::where('id', '=', $_POST['followee'])->first();
                $nb = $usr->followers;
                $usr->followers = $nb - 1;
                $usr->save();
            }else{
                if(!$flw){
                    $newFlw = new Follow;
                    $newFlw->follower = $_SESSION['user_profile']['id'];
                    $newFlw->followee = $_POST['followee'];
                    $newFlw->save();

                    $usr = User::where('id', '=', $_POST['followee'])->first();
                    $nb = $usr->followers;
                    $usr->followers = $nb + 1;
                    $usr->save();
                }
            }
        }
        $uid = AbstractAuthentification::connectedUser();
        $usr = User::where('id', '=', $uid)->firstOrFail();
        $data = Follow::where('follower', '=', $uid)->get();
        $followingView = new FollowingView($data);
        $followingView->makePage();
    }
}