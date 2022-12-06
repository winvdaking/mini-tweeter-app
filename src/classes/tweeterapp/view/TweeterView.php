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
        $html .= $this->makeHeader();
        $html .= $this->render();
        $html .= $this->makeFooter();

        return  $html;
    }

    public function makeHeader(): string
    {        
        //A REFAIRE PROPREMENT
        $htmlHeaderCo = '<header class="theme-backcolor1"> 
        <h1>MiniTweeTR</h1>  
        <nav id="navbar">
        <a class="tweet-control" href="'. $this->router->urlFor('default') . '">
        <img alt="home" ></a>
        <a class="tweet-control" href="'. $this->router->urlFor('login') .'">
        <img alt="login" ></a>
        <a class="tweet-control" href="'. $this->router->urlFor('signup') .'">
        <img alt="signup"></a>
        </nav> 
        </header>';

        $htmlHeaderNotCo = '<header class="theme-backcolor1"> 
        <h1>MiniTweeTR</h1>  
        <nav id="navbar">
        <a class="tweet-control" href="'. $this->router->urlFor('default') . '">
        <img alt="home" ></a>
        <a class="tweet-control" href="'. $this->router->urlFor('home') .'">
        <img alt="me" ></a>
        <a class="tweet-control" href="'. $this->router->urlFor('logout') .'">
        <img alt="logout"></a>
        </nav> 
        </header>';

        return !isset($_SESSION['user_profile']) ? $htmlHeaderCo : $htmlHeaderNotCo;
    }

    public function makeFooter(): string
    {
        $htmlFooter = '';
        $htmlFooter .= '<nav id="menu" class="theme-backcolor1">
        <div id="nav-menu">
        <div class="button theme-backcolor2">
        <a href="' . $this->router->urlFor('post', []) . '">New</a></div></div></nav>';
        $htmlFooter .= '<footer class="theme-backcolor1"> La super app créée en Licence Pro &copy;2018 Dorian</footer>';
        return $htmlFooter;
    }
}
