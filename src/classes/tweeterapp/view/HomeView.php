<?php

namespace iutnc\tweeterapp\view;

use iutnc\mf\view\Renderer;

class HomeView extends TweeterView implements Renderer{

    public function render(): string
    {
        $html = '<h2>Tous les tweets</h2>';
        $html .= '<ul>';

        foreach ($this->data as $val) {
            $html .= "<li>{$val->id}. {$val->text}</li>";
        }
        $html .= '</ul>';

        return $html;
    }

    public function makeBody(): string
    {
        return $this->render();
    }
}