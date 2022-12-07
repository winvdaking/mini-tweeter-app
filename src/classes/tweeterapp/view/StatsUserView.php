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

        $followee = Follow::where('followee', '=', $this->data->id)->get();
        if (count($followee)) {
            foreach ($followee as $value) {
                $usr = User::where('id', '=', $value->follower)->first();
                $html .= "<div class='tweet'>";
                $html .= "<div class='tweet-text'><strong>{$usr->fullname}</strong> suit {$this->data->fullname}</div>";
                $html .= "</div>";
            }
        }else{
            $html .= "<div class='tweet'>";
            $html .= "<div class='tweet-text'>Personne ne suit {$this->data->fullname}...</div>";
            $html .= "</div>";
        }
        
        $html .= '</article></section>';

        return $html;
    }
}
