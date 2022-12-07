<?php

namespace iutnc\tweeterapp\view;

use iutnc\mf\view\AbstractView;
use iutnc\mf\view\Renderer;

abstract class TweeterView extends AbstractView implements Renderer
{

    /* Méthode makeBody 
     * 
     * Retourne le contenu HTML de la balise body autrement dit le
     * contenu du document. 
     *
     * 
     * Retourne : 
     *
     * - Le contenu HTML complet entre les balises <body> </body> 
     *
     */
    public function makeBody(): string
    {
        $html = '';
        $html .= $this->renderTopMenu();
        $html .= $this->render();

        if(isset($_SESSION['user_profile']))
            $html .= $this->renderBottomMenu();

        $html .= $this->renderFooter();

        return  $html;
    }

    public function renderTopMenu(): string
    {        
        //A REFAIRE PROPREMENT
        $htmlHeaderCo = '<header class="theme-backcolor1"> 
        <h1>MiniTweeTR</h1>  
        <nav id="navbar">
        <a class="tweet-control" href="'. $this->router->urlFor('default') . '">
        <img alt="home" src="https://homepages.loria.fr/ABoumaza/teaching/php-lp/project/figs/home.png"></a>
        <a class="tweet-control" href="'. $this->router->urlFor('login') .'">
        <img alt="login" src="https://homepages.loria.fr/ABoumaza/teaching/php-lp/project/figs/login.png" ></a>
        <a class="tweet-control" href="'. $this->router->urlFor('signup') .'">
        <img alt="signup" src="https://homepages.loria.fr/ABoumaza/teaching/php-lp/project/figs/signup.png"></a>
        </nav> 
        </header>';

        $htmlHeaderNotCo = '<header class="theme-backcolor1"> 
        <h1>MiniTweeTR</h1>  
        <nav id="navbar">
        <a class="tweet-control" href="'. $this->router->urlFor('default') . '">
        <img alt="home" src="https://homepages.loria.fr/ABoumaza/teaching/php-lp/project/figs/home.png" ></a>
        <a class="tweet-control" href="'. $this->router->urlFor('following') .'">
        <img alt="following" src="https://homepages.loria.fr/ABoumaza/teaching/php-lp/project/figs/followees.png" ></a>
        <a class="tweet-control" href="'. $this->router->urlFor('logout') .'">
        <img alt="logout" src="https://homepages.loria.fr/ABoumaza/teaching/php-lp/project/figs/logout.png"></a>
        </nav> 
        </header>';

        return !isset($_SESSION['user_profile']) ? $htmlHeaderCo : $htmlHeaderNotCo;
    }

    public function renderBottomMenu(): string
    {
        $htmlFooter = '';
        $htmlFooter .= '<nav id="menu" class="theme-backcolor1">
        <div id="nav-menu">
        <div class="button theme-backcolor2">
        <a href="' . $this->router->urlFor('post', []) . '">Poster un tweet</a></div></div></nav>';
        return $htmlFooter;
    }

    public function renderFooter(): string
    {
        $htmlFooter = '';
        $htmlFooter .= '<footer class="theme-backcolor1"> La super app créée en Licence Pro &copy;2018 Dorian</footer>';
        return $htmlFooter;
    }
}
