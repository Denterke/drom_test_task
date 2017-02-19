<?php

class Controller {

    public $model;
    public $view;
    public $entityManager;

    function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->view = new View();
    }

    function action_index()
    {
    }
}