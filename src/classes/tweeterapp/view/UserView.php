<?php

namespace iutnc\tweeterapp\view;

use iutnc\tweeterapp\model\User;

class UserView extends TweeterView{

    public function render(): string
    {
        $user = User::where('id', '=', $this->data[0]->author)->first();

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
        $html .= '</article>';

        return $html;
    }
}