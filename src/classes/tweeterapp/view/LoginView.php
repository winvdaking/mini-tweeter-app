<?php

namespace iutnc\tweeterapp\view;

class LoginView extends TweeterView
{
    public function render(): string
    {
        $html = '';
        $html .= '<article class="theme-backcolor2">
        <form class="forms" action="'. $this->router->urlFor('login') .'" method=post>
        <input class="forms-text" type=text name=username placeholder="Nom d\'utilisateur">
        <input class="forms-text" type=password name=password placeholder="Mot de passe">
        <button class="forms-button" name=login_button type="submit">Login</button>
        </form></article>';

        return $html;
    }
}
