<?php

namespace iutnc\tweeterapp\view;

use iutnc\tweeterapp\model\User;
use iutnc\tweeterapp\model\Follow;

class UserView extends TweeterView{

    public function render(): string
    {
        $user = User::where('id', '=', $this->data[0]->author)->first();
        $flw = Follow::where('followee', '=', $user->id)->where('follower', '=', $_SESSION['user_profile']['id'])->count();

        $html = '<article class="theme-backcolor2">';
        $html .= '<h2>Tweets from '. $user->username . ' ' . $user->fullname . '</h2><h3>'. $user->followers . ' follower</h3>';

        foreach ($this->data as $val) {

            $html .= "<div class='tweet'>";
            $html .= "<a href=" . $this->router->urlFor('view_tweet', [['id', $val->id]]) . ">";
            $html .= "<div class='tweet-text'>{$val->text}</div>";
            $html .= "</a>";
            $html .= "<div class='tweet-footer'>
            <hr><span class='tweet-score tweet-control'>{$val->score}</span></hr>
            <span class='tweet-timestamp'>{$val->created_at}</span>
            <a href=" . $this->router->urlFor('user', [['id', $user->id]]) . ">
            <span class='tweet-author'>{$user->username}</span>
            </a>";
            $html .= "</div>";
            $html .= "</div>";
        }

        if ($flw) {
            $html .= '
            <form class="forms" action="'. $this->router->urlFor('following') .'" method=post>
            <input type="hidden" value="'. $user->id . '" name="followee">
            <input type="hidden" value="true" name="unfollow">
            <button type="submit">Ne plus suivre</button>
            </form></article>';
        }else{
            $html .= '
            <form class="forms" action="'. $this->router->urlFor('following') .'" method=post>
            <input type="hidden" value="'. $user->id . '" name="followee">
            <button type="submit">Suivre</button>
            </form></article>';
        }

        $html .= '</article>';

        return $html;
    }
}