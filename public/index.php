<?php
require_once __DIR__ . "/../vendor/autoload.php";

$loader = new Twig_Loader_Filesystem('../views/');
$twig = new Twig_Environment($loader);
echo $twig->render('main.html');