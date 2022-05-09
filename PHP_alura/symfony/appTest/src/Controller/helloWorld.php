<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class helloWorld
{
    /**
     * @Route("/hello")
     */
    public function helloWorld(Request $request): Response{
        $pathInfo = $request->getPathInfo();
        $query = $request->query->all();
        return new JsonResponse([
            'mensagem' => 'Hello World',
            'pathInfo' => $pathInfo,
            'query' => $query
        ]);
    }

}