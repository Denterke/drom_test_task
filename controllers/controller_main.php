<?php

class Controller_Main extends Controller
{
    function index()
    {
        $this->view->generate('main.php');
    }

    function page_404()
    {
        $this->view->generate('404.php');
    }
}