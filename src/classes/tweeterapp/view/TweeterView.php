<?php

namespace iutnc\tweeterapp\view;

use iutnc\mf\view\AbstractView;
use iutnc\mf\view\Renderer;

abstract class TweeterView extends AbstractView
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
        return  $this->data;
    }
}
