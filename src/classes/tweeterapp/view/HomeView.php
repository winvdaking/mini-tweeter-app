<?php

namespace iutnc\tweeterapp\view;

use iutnc\tweeterapp\model\User;

class HomeView extends TweeterView
{

    public function render(): string
    {
        $html = '<section>
        <article class="theme-backcolor2">  
        <h2>Latest Tweets</h2>';

        foreach ($this->data as $val) {

            $user = User::where('id', '=', $val->author)->first();

            $html .= "<div class='tweet'>";
            $html .= "<a href='" . $this->router->urlFor('view_tweet', [['id', $val->id]]) . "'>";
            $html .= "<div class='tweet-text'>{$val->text}</div>";
            $html .= "</a>";
            $html .= "<div class='tweet-footer'>
            <span class='tweet-timestamp'>{$val->created_at}</span>
            <a href='" . $this->router->urlFor('user', [['id', $user->id]]) . "'>
            <span class='tweet-author'>{$user->username}</span>
            </a>";
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= '</article></section>';

        return $html;
    }
}
