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
        $htmlHeader = '<header class="theme-backcolor1"> 
        <h1>MiniTweeTR</h1>  
        <nav id="navbar">
        <a class="tweet-control" href="">
        <img alt="home" ></a>
        <a class="tweet-control" href="">
        <img alt="login" ></a>
        <a class="tweet-control" href="">
        <img alt="signup"></a>
        </nav> 
        </header>';

        return $htmlHeader;
    }

    public function makeFooter(): string
    {
        $htmlFooter = '<footer class="theme-backcolor1"> La super app créée en Licence Pro &copy;2018 Dorian</footer>';
        return $htmlFooter;
    }
}
