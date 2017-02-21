<?php

class View
{
    function __construct() {
        $this->loader = new Twig_Loader_Filesystem(__DIR__ . '/../views/');
        $this->twig = new Twig_Environment($this->loader);
    }

    function generate($template_view, $data = null)
    {
        echo ($data) ?  $this->twig->render($template_view, array('data' => $data)) : $this->twig->render($template_view);
    }
}

