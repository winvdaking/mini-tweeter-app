<?php

namespace iutnc\tweeterapp\view;

class PostView extends TweeterView
{
    public function render(): string
    {
        $html = ''; 
        $html .= '<article class="theme-backcolor2"><form action ="' . $this->router->urlFor('post', []) . '" method=post>';
        $html .= '<textarea id="tweet-form" name=text placeholder="Exprime toi..." maxlength=140></textarea>';  
        $html .= '<div><input id="send_button" type=submit name=send value="Poster"></div>';
        $html .= '</form></article>';

        return $html;
    }
}
