<?php

use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Controller\{
    Controller,
    DeleteVideoController,
    EditVideoController,
    Error404Controller,
    LoginController,
    LoginFormController,
    NewVideoController,
    VideoFormController,
    VideoListController,
    CreateConnection
};
use Alura\Mvc\Repository\UserRepository;
require_once __DIR__ . '/../vendor/autoload.php';

$pdo = CreateConnection::processaRequisicao();

$dbPath = __DIR__ . '/../db.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);
$userRepository = new UserRepository($pdo);

$routes = require_once __DIR__.'/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];


//session_start();

echo "<script> console.log(".session_start().");</script>";

session_regenerate_id();
$isLoginRoute = $pathInfo === '/login';
if(!array_key_exists('logado', $_SESSION) && !$isLoginRoute){
    header('Location: /login');
    return;
}


$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    $controller = new $controllerClass($videoRepository);
} else {
    $controller = new Error404Controller();
}

/** @var Controller $controller */
$controller->processaRequisicao();
