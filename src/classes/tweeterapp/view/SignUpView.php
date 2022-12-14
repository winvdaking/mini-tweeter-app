<?php

namespace iutnc\tweeterapp\view;

class SignUpView extends TweeterView
{
    public function render(): string
    {
        $html = '';
        $html .= '<article class="theme-backcolor2">
        <form class="forms" action="'. $this->router->urlFor('signup') .'" method=post>
        <input class="forms-text" type=text name=username placeholder="username">
        <input class="forms-text" type=text name=fullname placeholder="fullname">
        <input class="forms-text" type=password name=password placeholder="password">
        <button class="forms-button" name=login_button type="submit">Login</button>
        </form></article>';

        return $html;
    }
}
