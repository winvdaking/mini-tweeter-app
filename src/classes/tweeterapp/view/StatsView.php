<?php

namespace iutnc\tweeterapp\view;

use iutnc\tweeterapp\model\Follow;
use iutnc\tweeterapp\model\User;

class StatsView extends TweeterView
{
    public function render(): string
    {
        $html = '<section>
        <article class="theme-backcolor2">  
        <h2>Statistiques</h2>';

        foreach ($this->data as $value) {
            $following = Follow::where('follower', '=', $value->id)->count();
            $followers = Follow::where('followee', '=', $value->id)->count();

            $html .= "<div class='tweet'>";
            $html .= "<a href='" . $this->router->urlFor('stats_user', [['id', $value->id]]) . "'>";
            $html .= "<div class='tweet-text'><strong>{$value->fullname}</strong> : {$following} following & {$followers} follower(s)</div>";
            $html .= "</a>";
            $html .= "</div>";
        }
        $html .= '</article></section>';

        return $html;
    }
}
