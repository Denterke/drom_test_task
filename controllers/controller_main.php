<?php

class Controller_Main extends Controller
{
    function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->view  = new View();
    }

    function index()
    {
        if (isset($_COOKIE['hash']))
            $this->check_cookie() ? header('Location: /user') : $this->view->generate('main.php');
        else header('Location: /user');
    }

    function page_404()
    {
        $this->view->generate('404.php');
    }

    function check_cookie() {
        include __DIR__ . '/../models/user.php';

        $user = $this->entityManager
            ->getRepository('User')
            ->findOneBy(array
                ('hash' => $_COOKIE['hash'])
            );

        return $user ? true : false;
    }
}