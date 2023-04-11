<?php

use Alura\Mvc\Controller\DeleteVideoController;
use Alura\Mvc\Controller\EditVideoController;
use Alura\Mvc\Controller\NewVideoController;
use Alura\Mvc\Controller\VideoFormController;
use Alura\Mvc\Controller\VideoListController;

    return [
        'GET|/' => \Alura\Mvc\Controller\VideoListController::class,
        'GET|/novo-video' => \Alura\Mvc\Controller\VideoFormController::class,
        'POST|/novo-video' => \Alura\Mvc\Controller\NewVideoController::class,
        'GET|/editar-video' => \Alura\Mvc\Controller\VideoFormController::class,
        'POST|/editar-video' => \Alura\Mvc\Controller\EditVideoController::class,
        'GET|/remover-video' => \Alura\Mvc\Controller\DeleteVideoController::class,
    ];