<?php

namespace iutnc\tweeterapp\view;

class PostView extends TweeterView
{
    public function render(): string
    {
        $html = ''; 
        $html .= '<article class="theme-backcolor2"><form action ="' . $this->router->urlFor('post', []) . '" method=post>';
        $html .= '<textarea id="tweet-form" name=text placeholder="Enter your tweet..." maxlength=140></textarea>';  
        $html .= '<div><input id="send_button" type=submit name=send value="Send"></div>';
        $html .= '</form></article>';

        return $html;
    }
}
