<?php

/**
 * Created by PhpStorm.
 * User: denter
 * Date: 18.02.17
 * Time: 19:05
 */

class Controller_User extends Controller
{
    function __construct()
    {
        $this->model = new User();
        $this->view  = new View();
    }

    function index()
    {
        $this->view->generate('register.php');
    }

    function create()
    {
        $this->view->generate('register.php');
    }

    function store($entityManager, $request)
    {
        if ($this->model->validate($request)) {
            $this->model->setLogin($request['login']);
            $this->model->setPassword($request['password']);

            $entityManager->persist($this->model);
            $entityManager->flush();
        }
        else {
            foreach ($this->model->getErrors() as $key => $value) {
                echo $value, "<br>";
            }
        }
    }
}