<?php

class Route
{
    static function start()
    {
        // контроллер и метод по умолчанию
        $controller_name = 'main';
        $action = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if (!empty($routes[1]))
            $controller_name = $routes[1];

        // получаем имя метода
        if (!empty($routes[2]))
            $action = $routes[2];

        // добавляем префиксы
        $model_name = 'model_'.$controller_name;
        $controller_name = 'controller_'.$controller_name;

        // файл с классом модели
        $model_file = strtolower($model_name).'.php';
        $model_path = '../models/'.$model_file;
        if (file_exists($model_path))
            include '../models/'.$model_file;


        // файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = '../controllers/'.$controller_file;
        file_exists($controller_path) ? include '../controllers/'.$controller_file : Route::ErrorPage404();

        // создаем экземпляр контроллера
        $controller = new $controller_name;
        method_exists($controller, $action) ? $controller->$action() : Route::ErrorPage404();
    }

    function ErrorPage404()
    {
        include '../controllers/controller_main.php';
        $controller = new Controller_Main();
        $controller->page_404();
    }
}