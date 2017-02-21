<?php

class Route
{

    function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    function start()
    {
        // контроллер и метод по умолчанию
        $controller_name = 'main';
        $action = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (count($routes) > 3) {
            $this->ErrorPage404();
            exit;
        }

        // имя контроллера
        if (!empty($routes[1]))
            $controller_name = $routes[1];

        // имя метода
        if (!empty($routes[2]))
            $action = $routes[2];

        // префикс к контроллеру
        $model_name = $controller_name;
        $controller_name = 'controller_'.$controller_name;

        // файл с классом модели
        $model_file = strtolower($model_name).'.php';
        $model_path = '../models/'.$model_file;
        if (file_exists($model_path))
            include '../models/'.$model_file;


        // файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = '../controllers/'.$controller_file;
        file_exists($controller_path) ? include '../controllers/'.$controller_file : $this->ErrorPage404();

        // создаем экземпляр контроллера
        $controller = new $controller_name($this->entityManager);

        //Две ужасные тернарки, одна на проверку существования метода, вторая на проверку GET || POST
        method_exists($controller, $action) ? (($_SERVER['REQUEST_METHOD'] == 'POST') ? $controller->$action($_POST) : $controller->$action()) : $this->ErrorPage404();
    }

    function ErrorPage404()
    {
        include __DIR__ . '/../controllers/controller_main.php';
        $controller = new Controller_Main($this->entityManager);
        $controller->page_404();
    }
}