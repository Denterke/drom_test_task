<?php

/**
 * Created by PhpStorm.
 * User: denter
 * Date: 18.02.17
 * Time: 19:05
 */

class Controller_User extends Controller
{
    function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->model = new User();
        $this->view  = new View();
    }

    function index()
    {
        $this->view->generate('login.php');
    }

    function create()
    {
        $this->view->generate('register.php');
    }

    function store($request)
    {
        if ($this->model->validate($this->entityManager, $request)) {
            $this->model->setLogin($request['login']);
            $this->model->setPassword($request['password']);

            $this->entityManager->persist($this->model);
            $this->entityManager->flush();

            header('Location: /user');
        }
        else {
            $this->view->generate('register.php', $this->model->getErrors());
        }
    }

    function auth($request)
    {
        $user = $this->entityManager
            ->getRepository('User')
            ->findOneBy(array
                ('login' => $request['login'],
                'password' => md5($request['password']))
            );

        if ($user) {
            $hash = $this->generate_hash();

            setcookie("hash", $hash, time()+60*60*24*30, '/');

            $user->setHash($hash);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            header('Location: /');

        }
        else {
            $this->view->generate('login.php', array('ошибка' => 'Проверте правильность введенных данных!'));
        }
    }

    function generate_hash() {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $hash = "";
        $hash_lenght = strlen($chars) - 1;

        while (strlen($hash) < 15)
            $hash .= $chars[mt_rand(0, $hash_lenght)];

        return $hash;
    }

    function check_cookie() {
        $user = $this->entityManager
            ->getRepository('User')
            ->findOneBy(array
                ('hash' => $_COOKIE['hash'])
            );

        return $user ? true : false;
    }
}