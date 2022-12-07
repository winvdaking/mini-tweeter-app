<?php

namespace iutnc\tweeterapp\view;

use iutnc\tweeterapp\model\User;

class FollowingView extends TweeterView
{
    public function render(): string
    {
        $html = '<section>
        <article class="theme-backcolor2">  
        <h2>Following</h2>';

        foreach ($this->data as $val) {

            $user = User::where('id', '=', $val->followee)->first();

            $html .= "<div class='tweet'>";
            $html .= "<a href='" . $this->router->urlFor('user', [['id', $user->id]]) . "'>";
            $html .= "<div class='tweet-text'>{$user->fullname}</div>";
            $html .= "</a>";
            $html .= "</div>";
        }
        $html .= '</article></section>';

        return $html;
    }
}
