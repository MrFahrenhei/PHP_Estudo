<?php
namespace App\Controller;

use App\Entity\Developer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeveloperController
{
    /**
     * @Route("/desenvolvedores, methods={"POST"})
     */
    public function newer(Request $request): Response
    {
        $bodyRequistion = $request->getContent();
        $dadosJson = json_decode($bodyRequistion);

        $desenvolvedor1 = new Developer();
        $desenvolvedor1->id = $dadosJson->id;
        $desenvolvedor1->nome = $dadosJson->nome;
        $desenvolvedor1->cpf = $dadosJson->cpf;
        $desenvolvedor1->grau = $dadosJson->grau;

        return new JsonResponse($desenvolvedor1);
    }
}