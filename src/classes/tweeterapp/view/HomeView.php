<?php

namespace iutnc\tweeterapp\view;

use iutnc\tweeterapp\model\User;

class HomeView extends TweeterView{

    public function render(): string
    {
        $html = '<section>
        <article class="theme-backcolor2">  
        <h2>Latest Tweets</h2>';

        foreach ($this->data as $val) {

            $user = User::where('id', '=', $val->author)->first();

            $html .= "<div class='tweet'>";
            $html .= "<div class='tweet-text'>{$val->text}</div>";
            $html .= "<div class='tweet-footer'>
            <span class='tweet-timestamp'>{$val->created_at}</span>
            <span class='tweet-author'>{$user->username}</span>";
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= '</article></section>';

        return $html;
    }
}