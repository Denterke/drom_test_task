<?php

class Controller_Task extends Controller
{
    function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->model = new Task();
        $this->view  = new View();
    }

    function index()
    {
        $tasks_object = $this->entityManager
            ->getRepository('Task')
            ->findAll();

        if ($tasks_object) {
            $tasks = array();
            $task = array();

            foreach ($tasks_object as $task_object) {
                $task['task'] = $task_object->getTask();
                $task['is_complete'] = $task_object->getIsComplete();
                array_push($tasks, $task);
            }
        }

            echo json_encode($tasks);

    }

    function store($request)
    {
        if ($this->model->validate($request)) {
            $this->model->setTask($request['task']);
            $this->model->setIsComplete(false);
            $this->model->setUserId($_COOKIE['user_id']);

            $this->entityManager->persist($this->model);
            $this->entityManager->flush();

            header('Location: /');
        }
        else {
            $this->view->generate('main.php', $this->model->getErrors());
        }
    }
}