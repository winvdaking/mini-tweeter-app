<?php

namespace iutnc\tweeterapp\view;

use iutnc\tweeterapp\model\Follow;
use iutnc\tweeterapp\model\User;

class StatsUserView extends TweeterView
{
    public function render(): string
    {
        $html = '<section>
        <article class="theme-backcolor2">  
        <h2>Statistiques de ' . $this->data->fullname . '</h2>';

        $follower = Follow::where('followee', '=', $this->data->id)->get();
        if ($follower) {
            foreach ($follower as $value) {
                $usr = User::where('id', '=', $value->follower)->first();
                $html .= "<div class='tweet'>";
                $html .= "<div class='tweet-text'><strong>{$usr->fullname}</strong> suit {$this->data->fullname}</div>";
                $html .= "</div>";
            }
        }

        
        $html .= '</article></section>';

        return $html;
    }
}
