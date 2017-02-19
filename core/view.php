<?php

class View
{
    function __construct() {
        $this->loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
        $this->twig = new Twig_Environment($this->loader);
    }

    //public $template_view; // здесь можно указать общий вид по умолчанию.

    /*function generate($content_view, $template_view, $data = null)
    {

        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }


        include '/../views/'.$template_view;
    }*/

    function generate($template_view)
    {
        echo $this->twig->render($template_view);
    }
}

