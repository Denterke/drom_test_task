<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . "/../vendor/autoload.php";

//Настройки DOCTRINE
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../Entity"), $isDevMode);

$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'password',
    'dbname'   => 'drom_test_task_db',
);

$entityManager = EntityManager::create($dbParams, $config);

