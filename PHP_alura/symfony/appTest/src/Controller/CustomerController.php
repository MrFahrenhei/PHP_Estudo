<?php

namespace App\Controller;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CustomerController extends AbstractController
{
    /**
     * @property EntityManagerInterface $entityManager
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route ("/customer", methods={"POST"})
     */
    public function newCustomer(Request $request): Response{
        $bodyRequistion = $request->getContent();
        $dadosJson = json_decode($bodyRequistion);

        $customer1 = new Customer();
        $customer1->nome = $dadosJson->nome;
        $customer1->email = $dadosJson->email;
        $customer1->type = $dadosJson->type;
        $customer1->psw = $dadosJson->psw;

        $this->entityManager->persist($customer1);
        $this->entityManager->flush();

        return new JsonResponse($customer1);
    }

    /**
     * @Route("/customer", methods={"GET"})
     */
    public function getCustomers(ManagerRegistry $doctrine): Response{
        $repository = $doctrine->getRepository(Customer::class);
        $customersList = $repository->findAll();

        return new JsonResponse($customersList);
    }

    /**
     * @Route ("/customer/{id}", methods={"GET"})
     */

    public function searchById(ManagerRegistry $doctrine, Request $request): Response{
        $id = $request->get("id");
        $repository = $doctrine->getRepository(Customer::class);
        $customersByid = $repository->find($id);
        $returnWarning = is_null($customersByid)? Response::HTTP_NO_CONTENT : 200;

        return new JsonResponse($customersByid, $returnWarning);
    }

}